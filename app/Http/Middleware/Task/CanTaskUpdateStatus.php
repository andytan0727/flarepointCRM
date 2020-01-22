<?php

namespace App\Http\Middleware\Task;

use Closure;
use App\Models\Setting;
use App\Models\Task;

class CanTaskUpdateStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $task             = Task::findOrFail($request->id);
        $isAdmin          = auth()->user()->hasRole('administrator');
        $settings         = Setting::all();
        $settingscomplete = $settings[0]['task_complete_allowed'];
        if ($isAdmin) {
            return $next($request);
        }
        if (1 == $settingscomplete && auth()->user()->id != $task->fk_user_id_assign) {
            session()->flash('flash_message_warning', 'Only assigned user are allowed to close Task.');

            return redirect()->back();
        }

        return $next($request);
    }
}
