@extends (Theme::get().'.layout.app')



@section ('seo')



{!! SEO::generate() !!}



@endsection



@section ('head')

@if (Auth::check() && Profile::hasStore(Auth::id()))

@if (!is_null(Profile::hasStore(Auth::id())->tawk))

    <!--Start of Tawk.to Script-->

    <script type="text/javascript">

    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

    (function(){

    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

    s1.async=true;

    s1.src='https://embed.tawk.to/{{ Profile::hasStore(Auth::id())->tawk }}/default';

    s1.charset='UTF-8';

    s1.setAttribute('crossorigin','*');

    s0.parentNode.insertBefore(s1,s0);

    })();

    </script>

    <!--End of Tawk.to Script-->
    
		<link href="https://sooqwatheq.co/content/assets/front-end0/css/components-rtl.css?v=1.3.5" rel="stylesheet">

@endif

@endif

@endsection



@section ('content')



<div class="row">



    <div class="col-md-12">



        @if (!$store->status)

        <div class="alert bg-danger alert-styled-left">

            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>

            @lang ('return/error.lang_store_is_not_active')

        </div>

        @endif



        <div class="profile-cover">

            <div class="profile-cover-img lozad" data-background-image="{{ Helper::store_cover($store->username) }}"></div>

            <div class="media">

                <div class="media-left">

                    <a href="{{ Protocol::home() }}/store/{{ $store->username }}" class="profile-thumb">

                        <img data-src="{{ $store->logo }}" class="lozad img-circle img-md" alt="{{ $store->title }}">

                    </a>

                </div>



                <div class="media-body">

                    <h1>{{ $store->title }} <small class="display-block">

                    <ul class="list-inline list-inline-separate text-white no-margin">

                                <li>{{ Helper::date_ago($store->created_at) }}</li>

                                <li><img data-src="{{ Protocol::home() }}/content/assets/front-end/images/flags/{{ $store->country }}.png" class="lozad" style="width: 18px;margin-right: 8px;">{{ Countries::country_name($store->country) }}</li>



                                @if (Helper::settings_geo()->states_enabled)

                                <li>{{ Countries::state_name($store->state) }}</li>

                                @endif



                                @if (Helper::settings_geo()->cities_enabled)

                                <li>{{ Countries::city_name($store->city) }}</li>

                                @endif



                                @if (Auth::check() && !Auth::user()->is_admin)

                                @if (Auth::id() == $store->owner_id)

                                <li class="text-danger text-uppercase"><span class="text-muted">Ends at </span>{{ Helper::dateToFormatted($store->ends_at) }}</li>

                                @endif

                                @endif

                            </ul></small></h1>

                </div>



                <div class="media-right media-middle store-contact-url">

                    <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">

                        <li><a data-toggle="modal" data-target="#contactStore" href="{{ Protocol::home() }}/store/{{ $store->username }}/contact" class="btn btn-default legitRipple"><i class="icon-envelop3 position-left"></i> {{ Lang::get('store.lang_contact_store', ['store' => $store->title]) }}</a></li>

                    </ul>

                </div>

            </div>

        </div>

            

        <!-- Store profile -->

        <div class="panel panel-flat store-panel-rtl">

            <div class="panel-body">



                    <p>{!! nl2br($store->long_desc) !!}</p>

                

            </div>



            <div class="panel-footer panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a>

                <div class="heading-elements">

                    <ul class="list-inline list-inline-separate heading-text">

                        <li>

                            <b>{{ Helper::count_store_ads($store->owner_id) }}</b><span class="text-muted"> {{ Lang::get('store.lang_posts') }}</span>

                        </li>

                        <li>

                            <b>{{ Helper::count_store_views($store->owner_id) }}</b><span class="text-muted"> {{ Lang::get('store.lang_views') }}</span>

                        </li>

                        <li>

                            <b>{{ Helper::count_store_likes($store->owner_id) }}</b><span class="text-muted"> {{ Lang::get('store.lang_likes') }}</span>

                        </li>

                    </ul>



                    <div class="heading-elements pull-right">

                        <ul class="list-inline store-social-media">

                            <li><a href="#" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-pin" data-popup="tooltip" data-placement="top" data-container="body" title="{{ $store->address }}"></i></a></li>

                            @if ($store->website)

                            <li><a target="_blank" href="{{$store->website}}" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-hyperlink"></i></a></li>

                            @endif



                            @if ($store->fb_page)

                            <li><a target="_blank" href="{{ $store->fb_page }}" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-facebook"></i></a></li>

                            @endif



                            @if ($store->tw_page)

                            <li><a target="_blank" href="{{ $store->tw_page }}" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-twitter"></i></a></li>

                            @endif



                            @if ($store->go_page)

                            <li><a target="_blank" href="{{ $store->go_page }}" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-google"></i></a></li>

                            @endif



                            @if ($store->yt_page)

                            <li><a target="_blank" href="{{ $store->yt_page }}" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple"><i class="icon-youtube"></i></a></li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            

        </div>



        <!-- Contact Store Owners -->

        <div id="contactStore" class="modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header bg-success">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h5 class="modal-title">{{ Lang::get('store.lang_contact_store', ['store' => $store->title]) }}</h5>

                    </div>



                    <form action="{{ Protocol::home() }}/store/{{ $store->username }}/contact" method="POST" id="sendMessageStore">

                        <div class="modal-body">



                            <meta name="csrf-token" content="{{ csrf_token() }}">



                            <!-- Your Full Name -->

                            <div class="form-group">

                                <label>{{ Lang::get('store.lang_your_name') }}</label>

                                <input type="text" placeholder="{{ Lang::get('store.lang_your_name_placeholder') }}" class="form-control" name="fullname">

                            </div>



                            <!-- Your E-mail Address -->

                            <div class="form-group">

                                <label>{{ Lang::get('store.lang_email_address') }}</label>

                                <input type="text" placeholder="{{ Lang::get('store.lang_email_address_placeholder') }}" class="form-control" name="email">

                            </div>



                            <!-- Your Phone Number -->

                            <div class="form-group">

                                <label>{{ Lang::get('store.lang_phone_number') }}</label>

                                <input type="text" placeholder="{{ Lang::get('store.lang_phone_number_placeholder') }}" class="form-control" name="phone">

                            </div>



                            <!-- Email Subject -->

                            <div class="form-group">

                                <label>{{ Lang::get('store.lang_subject') }}</label>

                                <input type="text" placeholder="{{ Lang::get('store.lang_subject_placeholder') }}" class="form-control" name="subject">

                            </div>



                            <!-- Message -->

                            <div class="form-group">

                                <label>{{ Lang::get('store.lang_message') }}</label>

                                <textarea rows="3" placeholder="{{ Lang::get('store.lang_message_placeholder') }}" class="form-control" name="message"></textarea>

                            </div>



                        </div>



                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success">{{ Lang::get('store.lang_send_message') }}</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        

    </div>

        

    <!-- Lasted Ads -->

    <div class="col-md-9">

        

        <div class="row">



            @if (count($ads))

            @foreach ($ads as $ad)



            <div class="col-md-4">



                <div class="card card-blog">

                    <ul class="tags">

                        @if ($ad->is_featured)

                        <li>{{ Lang::get('home.lang_featured') }}</li>

                        @endif



                        @if ($ad->is_oos)

                        <li class="oos">{{ Lang::get('update_three.lang_out_of_stock') }}</li>

                        @endif

                    </ul>

                    <div class="card-image">

                        <a href="{{ Protocol::home() }}/listing/{{ $ad->slug }}" {{ !is_null($ad->affiliate_link) ? 'target="_blank"' : '' }}>

                            <div class="img card-ad-cover lozad" data-background-image="{{ EverestCloud::getThumnail($ad->ad_id, $ad->images_host) }}" title="{{ $ad->title }}"></div>

                        </a>

                    </div>

                    <div class="card-block">

                        <h5 class="card-title">

                            <a href="{{ Protocol::home() }}/listing/{{ $ad->slug }}">{{ $ad->title }}</a>

                        </h5>

                        <div class="card-footer">

                            <div id="price">

                                @if (!is_null($ad->regular_price))

                                <span class="price price-old"> {{ Helper::getPriceFormat($ad->regular_price, $ad->currency) }}</span>

                                @endif

                                <span class="price price-new"> {{ Helper::getPriceFormat($ad->price, $ad->currency) }}</span>

                            </div>

                            <div class="author">

                                <div class="card__avatar"><a href="{{ Profile::hasStore($ad->user_id) ? Protocol::home().'/store/'.Profile::hasStore($ad->user_id)->username : '#' }}" class="avatar__wrapper--verified avatar__wrapper avatar__wrapper--40"><img data-src="{{ Profile::picture($ad->user_id) }}" alt="{{ Profile::hasStore($ad->user_id) ? Profile::hasStore($ad->user_id)->title : Profile::full_name($ad->user_id) }}" class="avatar lozad" width="40" height="40">@if (Profile::hasStore($ad->user_id))<i class="icon-checkmark3" data-popup="tooltip" data-placement="top" data-container="body" title="{{ Lang::get('update_two.lang_verified_account') }}"></i>@endif</a></div>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



            @endforeach



            <div class="text-center" style="width: 100%;float: left;">

                {{ $ads->links() }}

            </div>



            @else

            <div class="col-md-12">

                <div class="alert bg-info alert-styled-left">

                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>

                    @lang ('return/info.lang_nothing_to_show')

                </div>

            </div>

            @endif



        </div>



    </div>



    <!-- Right Side -->

    <div class="col-md-3">

        

        <!-- Categories -->

        <div class="panel panel-flat">

            <div class="category-title">

                <span>{{ Lang::get('store.lang_categories') }}</span>

            </div>



            <div class="category-content no-padding">

                <ul class="navigation navigation-alt navigation-accordion">



                    @if(count(Helper::parent_categories()))

                    @foreach (Helper::parent_categories() as $parent_category)



                    <li class="navigation-header">{{ $parent_category->category_name }}</li>

                    @if (count(Helper::sub_categories($parent_category->id)))

                    @foreach (Helper::sub_categories($parent_category->id) as $sub)

                    <li><a href="{{ Protocol::home() }}/category/{{ $parent_category->category_slug }}/{{ $sub->category_slug }}" class="text-semibold text-black"><span class="badge badge-default">{{ Helper::count_ads_by_category_user($sub->id, $store->owner_id) }}</span> {{ $sub->category_name }}</a></li>

                    @endforeach

                    @endif



                    @endforeach

                    @endif



                </ul>

            </div>

        </div>

        <!-- /categories -->



    </div>



</div>





@endsection