@if (isset($setting))
<form action="{{ route('setting.update', $setting) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
@else
    <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf

    <div class="row ms-3 mr-3">
        <h5 class="card-title ms-3 mr-3">
        Facebook Page ID
        </h5>
        <div class="col-6 mb-4">
            {{ Form::label("fb_page_id","Facebook Page ID: *",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("fb_page_id",@$setting->fb_page_id,["class"=>"form-control  ","placeholder"=>"Enter Facebook Page ID Here.....","required"=>false])}}

        </div>
        <div class="col-6 mb-4">
            {{ Form::label("fb_pages_id","Facebook Pages: *",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("fb_pages_id",@$setting->fb_pages_id,["class"=>"form-control  ","placeholder"=>"Enter Pages ID here.....","required"=>false])}}
        </div>
        <div class="col-6 mb-4">
            {{ Form::label("fb_app_id","Facebook App ID: *",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {{ Form::text("fb_app_id",@$setting->fb_app_id,["class"=>"form-control  ","placeholder"=>"Enter Facebook App ID here.....","required"=>false])}}
        </div>
        <div class="col-6 mb-4">
            {{ Form::label("google_analytics_code","Google Analytics Tracking Code: *",["class"=>"form-label","style"=>"font-weight:bold"])}}
            {!! Form::textarea("google_analytics_code",@$setting->google_analytics_code,["class"=>"form-control  ","placeholder"=>"Enter your Google Analytics tracking code","required"=>false]) !!}
        </div>
    </div>

<div class="text-center mt-2">
    {{ Form::button('<i class="bi bi-x"></i> Reset',['class'=>'btn btn-sm btn-danger','type'=>'reset'])}}
    @isset($setting)
    {{ Form::button('<i class="bi bi-send"></i> Submit',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @else
    {{ Form::button('<i class="bi bi-send"></i> Add',['class'=>'btn btn-sm btn-success','type'=>'submit'])}}
    @endisset
</div>

</form>

