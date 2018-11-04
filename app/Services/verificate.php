<?php 

namespace App\Services;

use App\Models\Subscription;
use App\Models\Activity;

class Verificate
{

	public function is_signed($user_id, $activity_id)
	{
		$signed = 0;
		$verificate = Subscription::where('user_id', $user_id)
		->where('activity_id', $activity_id)
		->get();
		foreach ($verificate as $verify) {
			if($verify)
				$signed = 1;
		}

		return $signed;
	}

	public function is_full($activity_id)
	{
		$full = 0;
		$subscriptions = Subscription::where('activity_id', $activity_id)->count();
		$capacity = Activity::select('maximum_capacity')
		->where('id', $activity_id)
		->get();
		if($subscriptions >= $capacity[0]->maximum_capacity)
			$full = 1;

		return $full;
	}

	public function event_time($user_id, $activity_id)
	{
		$same_time = 0;

		#Inscrição que o usuário deseja fazer
		$event_time = Activity::where('id', $activity_id)
		->get();

		#Inscrições do usuário 
		$user_subscriptions = Subscription::where('user_id', $user_id)
		->join('activities', 'subscriptions.activity_id', '=', 'activities.id')
		->get();

		if(isset($user_subscriptions[0]->beginning_datetime)){
			foreach ($user_subscriptions as $user_subscription) {
				print_r($user_subscription);
				if ($event_time[0]->beginning_datetime == $user_subscription->beginning_datetime) 
					$same_time = 1;
			}
		}

		return $same_time;
	}

}


