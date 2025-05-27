<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CustomerDraft;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) 
        {
            $user =Auth::user();
            if($user){
                if( Auth::user()->role_id == 1)
                {
                $drafts = CustomerDraft::select('customer.representative_name','customer.agent_id','customer_draft.created_at','customer.company_logo','customer_draft.customer_draft_id','customer_draft.is_seen')
                ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
                ->where('customer_draft.draft_status','Quotation')
                ->orderBy('customer_draft.created_at', 'desc')
                ->get();
                $countQuotation = CustomerDraft::where('draft_status', 'Quotation')->count();
                $unseen = CustomerDraft::where('draft_status', 'Quotation')
                ->where('is_seen', '0')
                ->count();
                }else{
                    $drafts = CustomerDraft::select('customer.representative_name','customer.agent_id','customer_draft.created_at','customer.company_logo','customer_draft.customer_draft_id','customer_draft.is_seen')
                    ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
                    ->where('customer.agent_id', Auth::user()->id)
                    ->where('customer_draft.draft_status','Quotation')
                    ->orderBy('customer_draft.created_at', 'desc')
                    ->get();
                    $countQuotation = CustomerDraft::select('customer.agent_id')
                    ->where('customer.agent_id', Auth::user()->id)
                    ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
                    ->where('draft_status', 'Quotation')->count();
                    $unseen = CustomerDraft::select('customer.agent_id')
                    ->where('customer.agent_id', Auth::user()->id)
                    ->leftjoin('customer','customer.user_id','customer_draft.customer_id')->where('draft_status', 'Quotation')
                    ->where('is_seen', '0')
                    ->count();

                }
            }else{
                $drafts = CustomerDraft::select('customer.representative_name','customer.agent_id','customer_draft.created_at','customer.company_logo','customer_draft.customer_draft_id','customer_draft.is_seen')
                ->leftjoin('customer','customer.user_id','customer_draft.customer_id')
                ->where('customer_draft.draft_status','Quotation')
                ->orderBy('customer_draft.created_at', 'desc')
                ->get();
                $countQuotation = CustomerDraft::where('draft_status', 'Quotation')->count();
                $unseen = CustomerDraft::where('draft_status', 'Quotation')
                ->where('is_seen', '0')
                ->count();
            }

           

           

             $view->with('drafts', $drafts)->with('countQuotation', $countQuotation)->with('unseen', $unseen);
         });

    }
}
