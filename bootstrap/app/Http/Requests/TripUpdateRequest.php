<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|string',
            'trip_cost'=>'nullable|integer',
            'mega_special_trip'=>'nullable|in:0,1',
            'home_page_slider'=>'nullable|in:0,1',
            'show_on_home_page'=>'nullable|in:0,1',
            'description'=>'nullable|string',
            'overview'=>'nullable|in:0,1',
            'itinerary'=>'nullable|in:0,1',
            'date_price'=>'nullable|in:0,1',
            'reviews'=>'nullable|in:0,1',
            'faq'=>'nullable|in:0,1',
            'train_yourself'=>'nullable|in:0,1',
            'gear_list'=>'nullable|in:0,1',
            'banner_image'=>'nullable',
            'tag_id'=>'nullable|exists:trip_tags,id',
            'meta_titles'=>'nullable|string',
            'meta_keywords'=>'nullable|string',
            'meta_descriptions'=>'nullable|string',
            'status'=>'required|in:active,inactive',
            'overview_slogan'=>'nullable|string',
            'overview_image'=>'nullable',
            'overview_trip_type_summary'=>'nullable|string',
            'overview_trip_summary'=>'nullable|string',
            'overview_description'=>'nullable|string',
            'overview_trip_code'=>'nullable|string',
            'overview_duration'=>'nullable|int',
            'overview_group_sizes'=>'nullable|int',
            'overview_best_season'=>'nullable|string',
            'overview_level_start'=>'required|in:easy,medium,strenuous,hard',
            'overview_level_end'=>'required|in:medium,strenuous,hard',
            'overview_trek_day'=>'nullable|int',
            'overview_activities'=>'nullable|string',
            'overview_arrival_city'=>'nullable|string',
            'overview_departure_city'=>'nullable|string',
            'overview_transportation'=>'nullable|string',
            'overview_trip_route'=>'nullable|string',
            'overview_cost_includes'=>'nullable|string',
            'overview_cost_excludes'=>'nullable|string',
            'overview_price_schedule'=>'nullable|string',
            'train_banner_image'=>'nullable',
            'train_description'=>'nullable|string',
            'gallery_image*'=>'nullable',
            'gear_description'=>'nullable|string',
            'gear_banner_image'=>'nullable',
            'itineary_map_id'=>'nullable|int',
            'itineary_heading'=>'nullable',
            'itineary_description'=>'nullable',
            'faq_banner_image'=>'nullable',
            'faq_question'=>'nullable',
            'faq_answer'=>'nullable',
            'date_banner_image'=>'nullable',
            'date_description'=>'nullable',
            'slogan'=>'nullable|string',
            'summary'=>'nullable|string'
        ];
    }
}
