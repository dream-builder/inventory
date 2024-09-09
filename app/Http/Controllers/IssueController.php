<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class IssueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index() {
		
		//return Zilla::all();

        //query
        /*
         * with ictable as (

                  select i.id,
                         i.facility_id,
                         i.user_id,
                         i.details,
                         i.category,
                         i.priority,
                         i.tags,
                         i.create_date,
                         i.completion_date,
                         i.status,
                         --case when i.status = 'ongoing' then 'Pending' end "i.status",
                         u.name,
                         fr.zillaid as zillaid,
                         fr.upazilaid as upazilaid,
                         fr.unionid as unionid,
                         fr.facility_name as facility_name,
                         z."ZillaNameEng"    as zilla_name,
                         uz."UpazilaNameEng" as upazila_name,
                         un."UnionNameEng"   as union_name

                  from issues i
                           left join users u on u.user_id = i.user_id
                           left join facility_registry fr on fr.facilityid = i.facility_id
                           left join "Zilla" z on z."ZillaId" = fr.zillaid
                           left join "Upazila" uz on uz."UpazilaId" = fr.upazilaid and uz."ZillaId" = fr.zillaid
                           left join "Unions" un on un."ZillaId" = fr.zillaid and un."UpazilaId" = fr.upazilaid and
                                                    un."UnionId" = fr.unionid
             -- )

	)
		select  zillaid, upazilaid, zilla_name, upazila_name, count(

			case when category = 'issue' then 1 else NULL end

			) as "Issue",

			count(

			case when ictable.category = 'comment' then 1 else NULL end

			) as "Comment"
			from ictable

		--left join ictable ic1 on ic1.zillaid = ictable.zillaid and ic1.upazilaid = ictable.upazilaid and ic1.unionid = ictable.unionid
		where zillaid = '56'

		group by zillaid, upazilaid,zilla_name,upazila_name



		-- group by upazila_name,ic_table.category

         */

        return view('issue/issue_view');
    }
	
	
	
    
}
