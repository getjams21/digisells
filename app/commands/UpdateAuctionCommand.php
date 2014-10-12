<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
// use Illuminate\Database\Eloquent\;

class UpdateAuctionCommand extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'digisells:update-auctions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Automatically update ended Auctions.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->everyMinutes(5);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//search for ended auctions with bidders
		$endedAuctions = DB::select('
			select a.*, b.id as biddingID, b.userID as buyerID, b.amount from auction as a
			inner join bidding as b on a.id = b.auctionID
			where b.highestBidder = 1 and a.endDate < NOW() and a.sold = 0
			');

		if($endedAuctions){
			foreach ($endedAuctions as $auction) {
				//remark auction as sold
				$updateAuction = Auction::find($auction->id);
				$updateAuction->sold = 1;
				$updateAuction->save();

				//put new record for sales
				$sales = new Sales;
				$sales->auctionID = $auction->id;
				$sales->buyerID = $auction->buyerID;
				$sales->amount = $auction->amount;
				$sales->transactionNO = time();
				$sales->save();

				//deduct amount to current fund of buyer
				$buyer = User::find(Auth::user()->id);
				$buyer->fund -= (float) $sales->amount;
				$buyer->save();

				//add credits to buyer
				$credits = new Credits;
				$credits->userID = Auth::user()->id;
				$credits->salesID = $sales->id;
				$credits->creditAdded = ((float) $sales->amount * 0.01);
				$credits->save();

				//total credits
				// $creditsAdded = DB::select('select SUM(creditAdded) as added from credits where userID='.Auth::user()->id.'');
				// $creditsDeducted = DB::select('select SUM(creditDeducted) as deducted from credits where userID='.Auth::user()->id.'');
				// $totalCredits = (float) $creditsAdded[0]->added - (float) $creditsDeducted[0]->deducted;

				//add commission to company
				$company = User::find(1);
				$company->fund += ((float) $sales->amount * 0.09);
				$company->save();

				//add commission to affiliate if affiliated

				//add funds to the seller
				$totalAmount = ((float) $sales->amount - (float) $company->fund) - (float) $credits->creditAdded;
				$product = Product::find($updateAuction->productID);
				$seller = User::find($product->userID);
				$seller->fund += $totalAmount;
				$seller->save();
			}
		}
	}

	// /**
	//  * Get the console command arguments.
	//  *
	//  * @return array
	//  */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	// /**
	//  * Get the console command options.
	//  *
	//  * @return array
	//  */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
	// 	);
	// }

}
