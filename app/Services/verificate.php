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
		$event_time = Activity::with('schedule')
		->where('id', $activity_id)
		->get();

		#Inscrições do usuário 
		$user_subscriptions = Subscription::join('activities', 'subscriptions.activity_id', '=', 'activities.id')
		->join('schedules', 'activities.schedule_id', '=', 'schedules.id')
		->get();

		foreach ($user_subscriptions as $user_subscription) {
			if ($event_time[0]->beginning_date == $user_subscription->beginning_date
					&& $event_time[0]->schedule->name == $user_subscription->name 
						|| $event_time[0]->schedule->name == "VLI$user_subscription->name") 
				$same_time = 1;
		}

			return $same_time;
	}

}
