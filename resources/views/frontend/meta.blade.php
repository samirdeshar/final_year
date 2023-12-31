<meta name="title" content="{{ @$meta['meta_title'] ??$setting->meta_title }}">
<meta name="description" content="{{strip_tags(@$meta['meta_description'] ?? $setting->meta_description) }}">
<meta name="keywords" content="{{ @$meta['meta_keyword'] ??$setting->meta_keywords }}">

<meta property="og:title" content="{{ (@$cybercastpost->title)? @$cybercastpost->title : (@$meta['meta_title']??$setting->meta_title) }}">

<meta property="og:image" content="{{ @$meta['og_image'] ??$setting->logo}}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="675">
<meta property="og:image:alt" content="{{ @$meta['meta_title']??$setting->meta_title }}">
<meta property="og:description" content="{{ strip_tags(@$meta['meta_description']?? $setting->meta_description) }}">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ $setting->site_name }}" />
<meta property="og:locale" content="ne_NP" />
<meta name="twitter:card" content="{{  @$meta['og_image'] ??$setting->icon }}">
<meta name="twitter:site" content="{{ @$meta['twitter'] }}" />
<meta name="allow-search" content="yes" />
<meta name="author" content="{{ $setting->site_name }}" />
<meta name="copyright" content="{{ date('Y') }} {{ $setting->site_name }}" />
<meta name="coverage" content="Worldwide" />
<meta name="identifier" content="{{ url()->current() }}" />
<meta name="language" content="{{ app()->getLocale() }}" />
<meta name="Robots" content="home,FOLLOW" />
<link rel="canonical" href="{{ url()->current() }}"/>
<meta name="Googlebot" content="home, follow" />
<link rel="next" href="{{ route('home') }}" />
<meta property="fb:admins" content="" />
<meta property="fb:page_id" content="{{ @$setting->fb_page_id }}" />
<meta property="fb:pages" content="{{ @$setting->fb_pages_id }}" />
<meta property="og:type" content="article" />
<meta property="ia:markup_url" content="{{ url()->current() }}">
<meta property="ia:rules_url" content="{{ url()->current() }}">
<meta property="fb:app_id" content="{{ @$setting->fb_app_id }}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{ route('home') }}" />
<meta name="twitter:title" content= "{{ substr(@$meta['meta_title']??$setting->meta_title ,0,70)}}" />
<meta name="twitter:description" content="{{ substr(strip_tags(@$meta['meta_description']), 0,120) }}" />
<meta name="twitter:image" content=" {{ @$meta['og_image']??$setting->icon }}" />
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id='G-123455789"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-123455789');
</script> --}}
@if(@$setting->google_analytics_code)
    {!! @$setting->google_analytics_code !!}
@endif
