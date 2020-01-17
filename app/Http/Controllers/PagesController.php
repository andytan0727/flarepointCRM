<?php

namespace App\Http\Controllers;

use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class PagesController extends Controller
{
    protected $users;
    protected $clients;
    protected $settings;
    protected $tasks;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads
    ) {
        $this->users    = $users;
        $this->clients  = $clients;
        $this->settings = $settings;
        $this->tasks    = $tasks;
        $this->leads    = $leads;
    }

    private function generalStats()
    {
        return [
            'companyname'    => $this->settings->getCompanyName(),
            'users'          => $this->users->getAllUsers(),
            'totalClients'   => $this->clients->getAllClientsCount(),
            'totalTimeSpent' => $this->tasks->totalTimeSpent()
        ];
    }

    // =======================================
    // Leads
    // =======================================
    private function allLeads()
    {
        return [
            'allleads'             => $this->leads->leads(),
            'allCompletedLeads'    => $this->leads->allCompletedLeads(),
            'totalPercentageLeads' => $this->leads->percantageCompleted(),
        ];
    }

    private function monthlyCreatedLeads()
    {
        $createdLeadEachMonths = [];
        $leadCreated = [];

        foreach ($this->leads->createdLeadsMonthly() as $lead) {
            $createdLeadEachMonths[] = date('F', strtotime($lead->created_at));
            $leadCreated[] = $lead->month;
        }

        return compact(
            'createdLeadEachMonths',
            'leadCreated'
        );
    }

    private function monthlyCompletedLeads()
    {
        /**
         * Statistics for leads this month.
         */
        $leadCompletedThisMonth = $this->leads->completedLeadsThisMonth();
        $completedLeadEachMonths = [];
        $leadsCompleted = [];

        /**
         * Statistics for leads each month(For Charts).
         */
        foreach ($this->leads->completedLeadsMonthly() as $leads) {
            $completedLeadEachMonths[] = date('F', strTotime($leads->updated_at));
            $leadsCompleted[] = $leads->month;
        }

        return compact(
            'leadCompletedThisMonth',
            'completedLeadEachMonths',
            'leadsCompleted',
        );
    }

    private function todayCreatedLeads()
    {
        return ['createdLeadsToday' => $this->leads->createdLeadsToday()];
    }

    private function todayCompletedLeads(Type $var = null)
    {
        return ['completedLeadsToday' => $this->leads->completedLeadsToday()];
    }

    // =======================================
    // Tasks
    // =======================================
    private function allTasks()
    {
        return [
            'alltasks'             => $this->tasks->tasks(),
            'allCompletedTasks'    => $this->tasks->allCompletedTasks(),
            'totalPercentageTasks' => $this->tasks->percentageCompleted(),
        ];
    }

    private function monthlyCreatedTasks()
    {
        $createdTaskEachMonths = [];
        $taskCreated = [];

        // Created tasks
        foreach ($this->tasks->createdTasksMothly() as $task) {
            $createdTaskEachMonths[] = date('F', strTotime($task->created_at));
            $taskCreated[] = $task->month;
        }

        // Completed tasks
        $completedTaskEachMonths = [];
        $taskCompleted = [];

        foreach ($this->tasks->completedTasksMothly() as $tasks) {
            $completedTaskEachMonths[] = date('F', strTotime($tasks->updated_at)) ;
            $taskCompleted[] = $tasks->month;
        }

        return compact(
            'createdTaskEachMonths',
            'taskCreated',
            'completedTaskEachMonths',
            'taskCompleted'
        );
    }

    private function monthlyCompletedTasks()
    {
        return [
            'completedTasksMonthly' => $this->tasks->completedTasksMothly(),
            'taskCompletedThisMonth' => $this->tasks->completedTasksThisMonth(),
        ];
    }

    private function todayCreatedTasks()
    {
        return [
            'createdTasksToday' => $this->tasks->createdTasksToday()
        ];
    }

    private function todayCompletedTasks()
    {
        return ['completedTasksToday' => $this->tasks->completedTasksToday()];
    }


    /**
     * Dashboard view.
     *
     * @return mixed
     */
    public function dashboard()
    {
        return view('pages.dashboard', array_merge(
            $this->generalStats(),
            $this->allLeads(),
            $this->monthlyCompletedLeads(),
            $this->monthlyCreatedLeads(),
            $this->todayCompletedLeads(),
            $this->todayCreatedLeads(),
            $this->allTasks(),
            $this->monthlyCreatedTasks(),
            $this->monthlyCompletedTasks(),
            $this->todayCreatedTasks(),
            $this->todayCompletedTasks()
        ));
    }
}
