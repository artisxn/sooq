

<?php $__env->startSection('seo'); ?>

	<?php echo SEOMeta::generate(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link class="rs-file" href="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/slider/royalslider.css?v=1.3.6" rel="stylesheet">
    <link href="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/slider/skins/default/rs-default.css?v=1.3.6" rel="stylesheet">
    <link href="<?php echo e(Protocol::home()); ?>/content/assets/front-end/css/extras/starability-growRotate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/emojionearea/emojionearea.css" media="screen">
	<link rel="stylesheet" type="text/css" href="https://mervick.github.io/lib/google-code-prettify/skins/tomorrow.css" media="screen">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

	<script src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/pagination/jscroll.js"></script>

	<!-- Auto load comments on scroll -->
	<script type="text/javascript">
	    $(function() {
	        $('#commentScroll').jscroll({
	        	loadingHtml: '<button type="button" style="width:100%" class="btn btn-default" id="spinner-light-4"><i class="icon-spinner4 spinner position-left"></i> Loading more</button>',
	            autoTrigger: true,
	            nextSelector: '.pagination li.active + li a', 
	            contentSelector: '#commentScroll',
	            callback: function() {
	                $('ul.pagination:visible:first').hide();
	                $(".emojioneareaCm").each(function() {
				        $(this).html(emojione.toImage($(this).html()));
				    });
	            }
	        });
	    });
	      
	</script>

	<!-- Slider -->
	<script class="rs-file" src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/slider/jquery.royalslider.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			// Slider 
			$('#AdsSlider').royalSlider({
			    fullscreen: {
			      enabled: true,
			      nativeFS: true
			    },
			    controlNavigation: 'thumbnails',
			    autoScaleSlider: true, 
			    autoScaleSliderWidth: 980,     
			    autoScaleSliderHeight: 500,
			    loop: true,
			    imageScaleMode: 'fit-if-smaller',
			    navigateByClick: true,
			    numImagesToPreload:2,
			    arrowsNav:true,
			    arrowsNavAutoHide: true,
			    arrowsNavHideOnTouch: true,
			    keyboardNavEnabled: true,
			    fadeinLoadedSlide: false,
			    globalCaption: false,
			    globalCaptionInside: false,
			});


		});
	</script>
	<script type="text/javascript" src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/emojionearea/emojionearea.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function() {
	    	$("#commentContent").emojioneArea({
	    		search: false,
	    		useInternalCDN: true,
	    		recentEmojis: false,
	    		autocomplete: true,
	    		autocompleteTones: true
	    	});
		    $(".emojioneareaCm").each(function() {
		        $(this).html(emojione.toImage($(this).html()));
		    });
	  	});
	</script>
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=<?php echo e(config('google-maps.key')); ?>'></script>
    <script src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/js/plugins/locationpicker/locationpicker.jquery.min.js"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>

<!-- Contact Seller -->
<div id="contact_seller" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title text-uppercase"><?php echo e(Lang::get('ads/show.lang_contact_seller')); ?></h5>
			</div>

			<form action="<?php echo e(Protocol::home()); ?>/account/inbox/create" method="POST" id="contactSeller">

				<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

				<div class="modal-body">

					<!-- Subject -->
					<div class="form-group">
						<input type="text" placeholder="<?php echo e(Lang::get('ads/show.lang_subject')); ?>" class="form-control" name="msgSubject" id="msgSubject">
					</div>

					<!-- Message -->
					<div class="form-group">
						<textarea rows="5" name="msgContent" id="msgContent" class="form-control" placeholder="<?php echo e(Lang::get('ads/show.lang_your_message_placeholder')); ?>"></textarea>
					</div>

					<!-- Show Email OR Phone Number -->
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<select data-placeholder="Show Email Address" class="select" name="show_email" id="show_email">

									<option value="0"><?php echo e(Lang::get('ads/show.lang_hide_email_address')); ?></option>

									<option value="1"><?php echo e(Lang::get('ads/show.lang_show_email_address')); ?></option>

									
								</select>
							</div>

							<div class="col-sm-6">
								<select data-placeholder="Show Phone Number" class="select" name="show_phone" id="show_phone">

									<option value="0"><?php echo e(Lang::get('ads/show.lang_hide_phone_number')); ?></option>

									<option value="1"><?php echo e(Lang::get('ads/show.lang_show_phone_number')); ?></option>

									
								</select>
							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><?php echo e(Lang::get('ads/show.lang_send_message')); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php else: ?>

<!-- Login to contact seller -->
<div id="loginToContact" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="<?php echo e(Protocol::home()); ?>/auth/login?redirect=<?php echo e($ad->ad_id); ?>" method="POST">

				<?php echo e(csrf_field()); ?>


				<div class="panel-body login-form">
					<div class="text-center">
						<div class="icon-object border-blue text-blue"><i class="icon-key"></i></div>
						<h5 class="content-group"><?php echo e(Lang::get('auth/login.lang_login_to_your_account')); ?> <small class="display-block"><?php echo e(Lang::get('auth/login.lang_your_credentials')); ?></small></h5>
					</div>

					<div class="form-group has-feedback has-feedback-left <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
						<input type="text" class="form-control" placeholder="<?php echo e(Lang::get('auth/login.lang_email_address')); ?>" name="email" value="<?php echo e(old('email')); ?>">
						<div class="form-control-feedback">
							<i class="icon-envelop text-muted"></i>
						</div>
						<?php if($errors->has('email')): ?>
						<span class="help-block"><?php echo e($errors->first('email')); ?></span>
						<?php endif; ?>
					</div>

					<div class="form-group has-feedback has-feedback-left <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
						<input type="password" class="form-control" placeholder="<?php echo e(Lang::get('auth/login.lang_password')); ?>" name="password">
						<div class="form-control-feedback">
							<i class="icon-lock2 text-muted"></i>
						</div>
						<?php if($errors->has('password')): ?>
						<span class="help-block"><?php echo e($errors->first('password')); ?></span>
						<?php endif; ?>
					</div>

					<div class="form-group login-options">
						<div class="row">
							<div class="col-sm-4">
								<label class="checkbox-inline text-grey-400">
									<input type="checkbox" class="styled" name="remember" checked="">
									<?php echo e(Lang::get('auth/login.lang_remember_me')); ?>

								</label>
							</div>

							<div class="col-sm-8 text-right">
								<ul class="list-inline list-inline-separate heading-text">
									<?php if(Helper::settings_auth()->activation_type == 'sms'): ?>
									<li><a href="<?php echo e(Protocol::home()); ?>/auth/activation/phone/resend"><?php echo e(Lang::get('auth/login.lang_resend_activation_code')); ?></a></li>
									<?php elseif(Helper::settings_auth()->activation_type == 'email'): ?>
									<li><a href="<?php echo e(Protocol::home()); ?>/auth/activation/resend"><?php echo e(Lang::get('auth/login.lang_resend_activation_link')); ?></a></li>
									<?php else: ?> 
									<?php endif; ?>
									<li><a href="<?php echo e(Protocol::home()); ?>/auth/password/reset"><?php echo e(Lang::get('auth/login.lang_forgot_password')); ?></a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="recaptcha">
					
						<?php if(Helper::settings_security()->recaptcha): ?>
							<?php echo app('captcha')->render(); ?>
						<?php endif; ?>
						
					</div>

					<script type="text/javascript">
						$(".styled, .multiselect-container input").uniform({
					        radioClass: 'choice',
	        				wrapperClass: 'border-grey-400 text-grey-400'
					    });
					</script>

					<div class="form-group">
						<button type="submit" class="btn bg-blue btn-block"><?php echo e(Lang::get('auth/login.lang_login')); ?></button>
					</div>

					<div class="content-divider text-muted form-group"><span><?php echo e(Lang::get('auth/login.lang_or_sign_in_with')); ?></span></div>
					<ul class="list-inline form-group list-inline-condensed text-center list-inline-social">

						<!-- Facebook -->
						<li><a href="<?php echo e(Protocol::home()); ?>/auth/facebook" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>

						<!-- Twitter -->
						<li><a href="<?php echo e(Protocol::home()); ?>/auth/twitter" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>

						<!-- Google -->
						<li><a href="<?php echo e(Protocol::home()); ?>/auth/google" class="btn border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded"><i class="icon-google-plus"></i></a></li>

					</ul>

					<div class="content-divider text-muted form-group"><span><?php echo e(Lang::get('auth/login.lang_dont_have_account')); ?></span></div>
					<a href="<?php echo e(Protocol::home()); ?>/auth/register" class="btn btn-default btn-block content-group"><?php echo e(Lang::get('auth/login.lang_sigh_up')); ?></a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php endif; ?>

<!-- Show Phone Number -->
<div id="show_phone_number" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title text-uppercase"><?php echo e(Lang::get('ads/show.lang_seller_phone_number')); ?></h5>
			</div>

			<div class="modal-body">

				<!-- Phone Number -->
				<div class="form-group has-feedback has-feedback-left">
					<input type="text" class="form-control" readonly="" value="<?php echo e($getUser->phone_hidden ? 'PHONE HIDDEN BY THIS MEMBER' : $getUser->phone); ?>">
					<div class="form-control-feedback">
						<i class="icon-phone2"></i>
					</div>
				</div>

				<?php if($callQRCode): ?>
					<?php echo $callQRCode; ?>

				<?php endif; ?>

				<div class="text-center text-muted">
					<span class="text-danger"><?php echo e(Lang::get('ads/show.lang_phone_warning')); ?></span> <?php echo e(Lang::get('ads/show.lang_phone_warning_p')); ?>

				</div>

			</div>

		</div>
	</div>
</div>

<!-- Ad Details -->
<div class="row">
	
	<?php if(Auth::check()): ?>
	<?php if($ad->user_id == Auth::id()): ?>
	<div class="col-md-12">
		<div class="alert bg-info alert-styled-left">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<?php echo app('translator')->getFromJson('return/info.lang_this_is_one_of_your_ads'); ?>
	    </div>
	</div>
	<?php endif; ?>

	<?php if($ad->is_trashed): ?>
	<div class="col-md-12">
		<div class="alert bg-danger alert-styled-left">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<?php echo app('translator')->getFromJson('return/error.lang_this_ad_is_trashed'); ?>
	    </div>
	</div>
	<?php endif; ?>
	<?php endif; ?>

	<?php if(Auth::check()): ?>
	<?php if(!$ad->status): ?>
	<div class="col-md-12">
		<div class="alert alert-danger alert-styled-left alert-bordered">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<?php echo app('translator')->getFromJson('return/error.lang_this_ad_is_under_review'); ?>
	    </div>
	</div>
	<?php endif; ?>
	<?php endif; ?>

	<!-- Page Breadcrumb -->
	<div class="col-md-12">
		
		<div class="breadcrumb-line breadcrumb-line-component content-group-lg">
			<ul class="breadcrumb text-uppercase">
				<li><a href="<?php echo e(Protocol::home()); ?>/"><i class="icon-home2 position-left"></i> <?php echo e(Lang::get('header.lang_home')); ?></a></li>
				<li><a href="<?php echo e(Helper::get_category($ad->category, true)); ?>"><?php echo e(Helper::get_category($ad->category)); ?></a></li>
				<li class="active"><?php echo e($ad->title); ?></li>
			</ul>

			<ul class="breadcrumb-elements text-uppercase">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-gear position-left"></i>
						<?php echo e(Lang::get('options.lang_options')); ?>

						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-left">

						<?php if(Auth::check()): ?>

						<?php if(Auth::id() == $ad->user_id): ?>
						<!-- Edit Ad -->
						<li><a href="<?php echo e(Protocol::home()); ?>/account/ads/edit/<?php echo e($ad->ad_id); ?>"><i class="icon-pencil4"></i> <?php echo e(Lang::get('update_three.lang_edit_ad')); ?></a></li>
						
						<!-- Upgrade Ad -->
						<li><a href="<?php echo e(Protocol::home()); ?>/account/ads/upgrade/<?php echo e($ad->ad_id); ?>"><i class="icon-chess-queen"></i> <?php echo e(Lang::get('options.lang_upgrade_ad')); ?></a></li>

						<!-- Archive Ad -->
						<li><a href="<?php echo e(Protocol::home()); ?>/account/ads/archive/<?php echo e($ad->ad_id); ?>"><i class="icon-archive"></i> <?php echo e(Lang::get('options.lang_archive_ad')); ?></a></li>

						<!-- Ad Statis -->
						<li><a href="<?php echo e(Protocol::home()); ?>/account/ads/stats/<?php echo e($ad->ad_id); ?>"><i class="icon-stats-bars2"></i> <?php echo e(Lang::get('options.lang_statistics')); ?></a></li>
						<?php endif; ?>

						<li><a href="#" data-toggle="modal" data-target="#make_offer"><i class="icon-wallet pull-left"></i> <?php echo e(Lang::get('options.lang_make_offer')); ?></a></li>

						<li><a href="#" id="addToFavorite" data-ad-id="<?php echo e($ad->ad_id); ?>"><i class="icon-heart6 pull-left"></i> <?php echo e(Lang::get('options.lang_add_to_favorite')); ?></a></li>
						<?php endif; ?>

						<li><a href="#send" data-toggle="modal" data-target="#sendToFriend"><i class="icon-envelope pull-left"></i> <?php echo e(Lang::get('options.lang_send_to_friend')); ?></a></li>

						<li><a href="#report" data-ad-id="<?php echo e($ad->ad_id); ?>" id="reportAd"><i class="icon-flag7 pull-left"></i> <?php echo e(Lang::get('options.lang_report_abuse')); ?></a></li>

					</ul>
				</li>
			</ul>
		</div>

		<?php if(Auth::check()): ?>
		<div id="make_offer" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title text-uppercase"><?php echo e(Lang::get('ads/show.lang_make_offer')); ?></h5>
					</div>

					<form action="<?php echo e(Protocol::home()); ?>/offers/make" method="POST" id="sendOffer">
						<div class="modal-body">

							<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

							<!-- Your Price -->
							<div class="form-group">
								<label><?php echo e(Lang::get('ads/show.lang_your_price')); ?></label>
								<input type="text" placeholder="<?php echo e(Lang::get('ads/show.lang_your_price_placeholder')); ?>" id="offerPrice" class="form-control" name="price">
								<span class="help-block"><?php echo e(Lang::get('ads/show.lang_the_amount_required')); ?> <b><?php echo e(Helper::getPriceFormat($ad->price, $ad->currency)); ?></b></span>
							</div>

							<!-- Post ID -->
							<div class="form-group">
								<label><?php echo e(Lang::get('ads/show.lang_post_id')); ?></label>
								<input type="text" readonly="" placeholder="<?php echo e(Lang::get('ads/show.lang_post_id')); ?>" id="postID" value="<?php echo e($ad->ad_id); ?>" class="form-control" name="ad_id">
							</div>

						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success"><?php echo e(Lang::get('ads/show.lang_send_offer')); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<!-- Send to friend -->
		<div id="sendToFriend" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success text-uppercase">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title text-uppercase"><?php echo e(Lang::get('ads/show.lang_send_to_friend')); ?></h5>
					</div>

					<form action="<?php echo e(Protocol::home()); ?>/tools/send" method="POST" id="sendFriend">
						<div class="modal-body">

							<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" id="sendToFriendToken">

							<input hidden="" name="sendToFriendAdId" content="<?php echo e($ad->ad_id); ?>" id="sendToFriendAdId">

							<!-- Your Email Address -->
							<div class="form-group">
								<label><?php echo e(Lang::get('ads/show.lang_your_email_address')); ?></label>
								<input type="email" required="" placeholder="<?php echo e(Lang::get('ads/show.lang_your_email_address_placeholder')); ?>" id="senderEmail" class="form-control" name="senderEmail">
							</div>

							<!-- Friend Email Address -->
							<div class="form-group">
								<label><?php echo e(Lang::get('ads/show.lang_your_friend_email_address')); ?></label>
								<input type="email" required="" placeholder="<?php echo e(Lang::get('ads/show.lang_your_friend_email_address_placeholder')); ?>" id="friendEmail" class="form-control" name="friendEmail">
							</div>

							<!-- Message Content -->
							<div class="form-group">
								<label><?php echo e(Lang::get('ads/show.lang_your_message')); ?></label>
								<textarea rows="4" required="" placeholder="<?php echo e(Lang::get('ads/show.lang_your_message_placeholder')); ?>" id="messageContent" class="form-control" name="messageContent"></textarea>
							</div>

						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success"><?php echo e(Lang::get('ads/show.lang_send_message')); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-9">

		<div class="panel panel-flat">

			<div class="panel-body" style="padding: 0px">

					<div id="slideShow">

						<!-- Ad Photos -->
						<?php echo Helper::ad_photos($ad->photos, $ad->images_host); ?>


					</div>

			</div>

			<div class="panel-footer" style="border-top: 1px solid #efefef;padding: 2px;">
				<div class="heading-elements">
					<ul class="list-inline list-inline-separate heading-text text-muted pull-right">
						<li><?php echo e(Helper::dateToFormatted($ad->created_at)); ?> (<?php echo e(Helper::date_ago($ad->created_at)); ?>)</li>

						<?php if($ad->negotiable): ?>
						<li><?php echo e(Lang::get('create/ad.lang_negotiable')); ?></li>
						<?php else: ?>
						<li><?php echo e(Lang::get('create/ad.lang_not_negotiable')); ?></li>
						<?php endif; ?>

						<?php if($ad->is_used): ?>
						<li><?php echo e(Lang::get('update_three.lang_used_item')); ?></li>
						<?php else: ?>
						<li><?php echo e(Lang::get('update_three.lang_new_item')); ?></li>
						<?php endif; ?>
					</ul>
					<ul class="list-inline list-inline-separate heading-text pull-left quick-stats-rtl">
						<li><b><?php echo e($ad->views); ?></b><span class="text-muted"> <?php echo e(Lang::get('ads/show.lang_views')); ?></span></li>
						<li><b><?php echo e($ad->likes); ?></b><span class="text-muted"> <?php echo e(Lang::get('ads/show.lang_likes')); ?></span></li>
						<li><b><?php echo e(Helper::ad_comments($ad->ad_id)); ?></b><span class="text-muted"> <?php echo e(Lang::get('ads/show.lang_comments')); ?></span></li>
					</ul>
				</div>
			</div>

		</div>

		<!-- Ad Description -->
		<div class="panel panel-flat">

			<i class="icon-spinner4 spinner pull-right mt-10 mr-10 text-muted" style="display: none;" id="translateSpinner"></i>
			<div class="panel-body text-muted" id="ad_description">
				<?php echo nl2br($ad->description); ?>

			</div>

			<div class="panel-footer">
				<div class="heading-elements">

					<div class="btn-group">
						<input type="hidden" name="csrf-token" content="<?php echo e(csrf_token()); ?>" id="translateToken">

						<!-- Translator -->
						<a data-toggle="dropdown" href="whatsapp://send?text=<?php echo e($ad->title); ?> <?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>" class="dropdown-toggle translatorLink"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('ads/show.lang_translate')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/translator.png" class="lozad img-circle img-xs" alt=""></a>

	                	<ul class="dropdown-menu dropdown-menu-left translateLinks">
							<li><a class="translateTo" data-lang-to="ar" href="#"> العربية</a></li>
							<li><a class="translateTo" data-lang-to="en" href="#"> English</a></li>
							<li><a class="translateTo" data-lang-to="fr" href="#"> Français</a></li>
							<li><a class="translateTo" data-lang-to="es" href="#"> Español</a></li>
							<li><a class="translateTo" data-lang-to="tr" href="#"> Türkçe</a></li>
							<li><a class="translateTo" data-lang-to="ko" href="#"> 조선말</a></li>
							<li><a class="translateTo" data-lang-to="my" href="#"> Bahasa Melayu</a></li>
							<li><a class="translateTo" data-lang-to="pl" href="#"> Polski</a></li>
							<li><a class="translateTo" data-lang-to="ro" href="#"> Română</a></li>
							<li><a class="translateTo" data-lang-to="ru" href="#"> Русский</a></li>
							<li><a class="translateTo" data-lang-to="sk" href="#"> Slovenčina</a></li>
							<li><a class="translateTo" data-lang-to="fi" href="#"> Suomi</a></li>
							<li><a class="translateTo" data-lang-to="jp" href="#"> 日本語</a></li>
							<li><a class="translateTo" data-lang-to="ta" href="#"> Tamil</a></li>
							<li><a class="translateTo" data-lang-to="de" href="#"> Deutsch</a></li>
							<li><a class="translateTo" data-lang-to="sv" href="#"> Svenska</a></li>
							<li><a class="translateTo" data-lang-to="hu" href="#"> Magyar</a></li>
							<li><a class="translateTo" data-lang-to="uk" href="#"> Українська</a></li>
							<li><a class="translateTo" data-lang-to="id" href="#"> Bahasa Indonesia</a></li>
							<li><a class="translateTo" data-lang-to="th" href="#"> ไทเขิน</a></li>
							<li><a class="translateTo" data-lang-to="it" href="#"> Italiano</a></li>
							<li><a class="translateTo" data-lang-to="no" href="#"> Norsk</a></li>
							<li><a class="translateTo" data-lang-to="cs" href="#"> Český Jazyk</a></li>
							<li><a class="translateTo" data-lang-to="hi" href="#"> हिन्दी</a></li>
							<li><a class="translateTo" data-lang-to="zh-TW" href="#"> 中文繁體</a></li>
							<li><a class="translateTo" data-lang-to="zh-CN" href="#"> 简体中文</a></li>
							<li><a class="translateTo" data-lang-to="ga" href="#"> Gaeilge</a></li>
						</ul>

						<?php if(!is_null($ad->youtube)): ?>
						<?php if(Protocol::getYoutubeID($ad->youtube) != FALSE): ?>
						<!-- Youtube Video -->
						<a href="#" data-toggle="modal" data-target="#watchYoutubeVideo" class="translatorLink"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('update.lang_watch_video')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/youtube.png" class="lozad img-circle img-xs" alt=""></a>

						<!-- Video Iframe -->
						<div id="watchYoutubeVideo" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									
									<iframe class="lozad" width="100%" height="450" data-src="https://www.youtube.com/embed/<?php echo e(Protocol::getYoutubeID($ad->youtube)); ?>" frameborder="0" allowfullscreen></iframe>
									
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php endif; ?>

					</div>

					<ul style="margin-top: 3px;" class="list-inline heading-text pull-right shareButtons">
						
						<!-- Share on WhatsApp -->
						<li style="padding-right: 10px;"><a href="whatsapp://send?text=<?php echo e($ad->title); ?> <?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_via_whatsapp')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/whatsapp.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Share on Digg -->
						<li style="padding-right: 10px;"><a href="https://www.digg.com/submit?url=<?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>" target="_blank"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_on_digg')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/digg.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Share on Stumbleupon -->
						<li style="padding-right: 10px;"><a href="https://www.stumbleupon.com/submit?url=<?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>&title=<?php echo e($ad->title); ?>" target="_blank"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_on_stumbleupon')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/stumbleupon.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Share on Facebook -->
						<li style="padding-right: 10px;"><a href="https://www.facebook.com/sharer.php?u=<?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>" target="_blank"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_on_facebook')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/facebook.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Share on Twitter -->
						<li style="padding-right: 10px;"><a href="https://twitter.com/share?url=<?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>&text=<?php echo e($ad->title); ?>" target="_blank"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_on_twitter')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/twitter.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Share on Google Plus -->
						<li style="padding-right: 10px;"><a href="https://plus.google.com/share?url=<?php echo e(Protocol::home()); ?>/listing/<?php echo e($ad->slug); ?>" target="_blank"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_share_on_google')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/google.png" class="lozad img-circle img-xs" alt=""></a></li>

						<li style="padding-right: 10px;"><a data-toggle="modal" data-target="#scanQrCode" href="#"><img  data-popup="tooltip" data-placement="top" data-container="body" title="<?php echo e(Lang::get('tooltips.lang_scan_qr_code')); ?>" data-src="<?php echo e(Protocol::home()); ?>/content/assets/front-end/images/brands/qr-code.png" class="lozad img-circle img-xs" alt=""></a></li>

						<!-- Qr Code Scan -->
						<div id="scanQrCode" class="modal fade">
							<div class="modal-dialog modal-xs" style="width: 30%;">
								<div class="modal-content">
									<div class="modal-header bg-success">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h5 class="modal-title text-uppercase"><?php echo e(Lang::get('ads/show.lang_scan_qr_code')); ?></h5>
									</div>

									<div class="modal-body">

										<?php echo $qrCode; ?>


									</div>
								</div>
							</div>
						</div>

					</ul>
				</div>
			</div>
		</div>

		<!-- Seller Card -->
		<div class="card-profile">

			<?php if(Profile::hasStore($ad->user_id)): ?>
		    <div class="lozad card-profile-header" data-background-image="<?php echo e(Profile::cover_by_id($ad->user_id)); ?>"
		      >
	            <div class="card-header-slanted-edge">
	              	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 200"><path class="polygon" d="M-20,200,1000,0V200Z" /></svg>
	            </div>
		    </div>
		    <?php endif; ?>

		    <div class="card-profile-body">
		    	<?php if(Profile::hasStore($ad->user_id)): ?>
	          	<a href="<?php echo e(Protocol::home()); ?>/store/<?php echo e(Profile::hasStore($ad->user_id)->username); ?>" class="name"><?php echo e(Profile::hasStore($ad->user_id)->title); ?></a>
	          	<?php else: ?>
	          	<h2 class="name"><?php echo e(Profile::full_name($ad->user_id)); ?></h2>
	          	<?php endif; ?>
	          	<h4 class="job-title"><?php echo e(Countries::country_name($ad->country)); ?> <?php if( Helper::settings_geo()->states_enabled ): ?>/ <?php echo e(Countries::state_name($ad->state)); ?> <?php endif; ?> <?php if( Helper::settings_geo()->cities_enabled ): ?> / <?php echo e(Countries::city_name($ad->city)); ?> <?php endif; ?></h4>

				<div class="card-profile-buttons">

		          	<!-- Show Phone Number -->
		          	<button type="button" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple" data-toggle="modal" data-target="#show_phone_number"><b><i class="icon-phone2"></i></b> <?php echo e(Lang::get('update_two.lang_phone_number')); ?></button>

					<!-- Send message -->
		          	<button type="button" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple" data-toggle="modal" <?php if(auth()->guard()->check()): ?> data-target="#contact_seller" <?php endif; ?> <?php if(auth()->guard()->guest()): ?> data-target="#loginToContact" <?php endif; ?>><b><i class="icon-info3"></i></b> <?php echo e(Lang::get('update_two.lang_contact_seller')); ?></button>

	          	</div>

	          	<!-- Price -->
	          	<div id="price" style="float: none;margin-top: 16px">
	          		<?php if(!is_null($ad->regular_price)): ?>
                	<span class="price price-old" style="font-size: 17px !important;"> <?php echo e(Helper::getPriceFormat($ad->regular_price, $ad->currency)); ?></span>
                	<?php endif; ?>
                	<span class="price price-new" style="font-size: 20px !important;"> <?php echo e(Helper::getPriceFormat($ad->price, $ad->currency)); ?></span>
                </div>

		    </div>
		</div>

		<?php if(!is_null($ad->latitude) && !is_null($ad->longitude)): ?>
		<!-- Geo Location -->
		<div class="panel panel-flat">
			<div id="adGeoLocationMap" style="width: 100%;height: 450px"></div>
			<script>
                $('#adGeoLocationMap').locationpicker({
                    location: {
                        latitude: "<?php echo e($ad->latitude); ?>",
                        longitude: "<?php echo e($ad->longitude); ?>"
                    },
                    radius: <?php echo e($ad->radius); ?>

                });
            </script>
		</div>
		<?php endif; ?>

		<?php if(Helper::ifCanSeeAds()): ?>
		<!-- Advertisment -->
		<div class="advertisment">
			<?php echo Helper::advertisements()->ad_middle; ?>

		</div>
		<?php endif; ?>

		<div class="row">

			<!-- Related Ads -->
			<?php if(count($related_ads)): ?>
			<?php $__currentLoopData = $related_ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<div class="col-md-4">

                <div class="card card-blog">
                    <ul class="tags">
                        <?php if($related->is_featured): ?>
                        <li><?php echo e(Lang::get('home.lang_featured')); ?></li>
                        <?php endif; ?>

                        <?php if($related->is_oos): ?>
                        <li class="oos"><?php echo e(Lang::get('update_three.lang_out_of_stock')); ?></li>
                        <?php endif; ?>
                    </ul>
                    <div class="card-image">
                        <a href="<?php echo e(Protocol::home()); ?>/listing/<?php echo e($related->slug); ?>" <?php echo e(!is_null($related->affiliate_link) ? 'target="_blank"' : ''); ?>>
                            <div class="img card-ad-cover lozad" data-background-image="<?php echo e(EverestCloud::getThumnail($related->ad_id, $related->images_host)); ?>" title="<?php echo e($related->title); ?>"></div>
                        </a>
                    </div>
                    <div class="card-block">
                        <h5 class="card-title">
                            <a href="<?php echo e(Protocol::home()); ?>/listing/<?php echo e($related->slug); ?>"><?php echo e($related->title); ?></a>
                        </h5>
                        <div class="card-footer">
                            <div id="price">
                                <?php if(!is_null($related->regular_price)): ?>
                                <span class="price price-old"> <?php echo e(Helper::getPriceFormat($related->regular_price, $related->currency)); ?></span>
                                <?php endif; ?>
                                <span class="price price-new"> <?php echo e(Helper::getPriceFormat($related->price, $related->currency)); ?></span>
                            </div>
                            <div class="author">
                                <div class="card__avatar"><a href="<?php echo e(Profile::hasStore($related->user_id) ? Protocol::home().'/store/'.Profile::hasStore($related->user_id)->username : '#'); ?>" class="avatar__wrapper--verified avatar__wrapper avatar__wrapper--40"><img data-src="<?php echo e(Profile::picture($related->user_id)); ?>" alt="<?php echo e(Profile::hasStore($related->user_id) ? Profile::hasStore($related->user_id)->title : Profile::full_name($related->user_id)); ?>" class="lozad avatar" width="40" height="40"><?php if(Profile::hasStore($related->user_id)): ?><i class="icon-checkmark3" data-popup="tooltip" data-placement="top" data-container="body" title="Verified Account"></i><?php endif; ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>

		</div>

		<?php if(Profile::hasStore($ad->user_id)): ?>
		<!-- Reviews -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title text-semibold"><?php echo e(Lang::get('update_three.lang_leave_review')); ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>

				<div class="heading-elements">
					<ul class="list-inline list-inline-separate heading-text">
						<li><?php echo e(Lang::get('update_three.lang_rating')); ?> <span class="text-semibold"><?php echo e($average_rating); ?></span></li>
						<li>
							<?php switch(intval($average_rating)):
								case (1): ?>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<?php break; ?>

								<?php case (2): ?>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<?php break; ?>

								<?php case (3): ?>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<?php break; ?>

								<?php case (4): ?>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<?php break; ?>

								<?php case (5): ?>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<i class="icon-star-full2 text-size-base text-warning-300"></i>
									<?php break; ?>

								<?php default: ?>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>
									<i class="icon-star-full2 text-size-base text-grey-300"></i>

							<?php endswitch; ?>
							<span class="text-muted position-right">(<?php echo e(count($total_reviews)); ?>)</span>
						</li>
						<li>
							<a class="text-muted text-uppercase" target="_blank" href="<?php echo e(Protocol::home()); ?>/store/<?php echo e(Profile::hasStore($ad->user_id)->username); ?>/reviews/<?php echo e($ad->ad_id); ?>"><?php echo e(Lang::get('update_three.lang_all_reviews')); ?></a>
						</li>
					</ul>
            	</div>
			</div>

			<div class="panel-body pt-20">
				<div class="form-group">
					<textarea rows="5" cols="5" class="form-control review-comment" placeholder="<?php echo e(Lang::get('update_three.lang_leave_review_placeholder')); ?>" id="reviewComment"></textarea>
					<input type="hidden" name="csrf-token" id="reviewToken" content="<?php echo e(csrf_token()); ?>">
					<div class="help-block">
						<fieldset class="starability-growRotate"> 
						    <input type="radio" id="rate1" name="rating" value="1" />
						    <label for="rate1" title="Terrible">1 stars</label>

						    <input type="radio" id="rate2" name="rating" value="2" />
						    <label for="rate2" title="Not good">2 stars</label>

						    <input type="radio" id="rate3" name="rating" value="3" />
						    <label for="rate3" title="Average">3 stars</label>

						    <input type="radio" id="rate4" name="rating" value="4" />
						    <label for="rate4" title="Very good">4 stars</label>

						    <input type="radio" id="rate5" checked="" name="rating" value="5" />
						    <label for="rate5" title="Amazing">5 star</label>
						</fieldset>

					</div>
				</div>
			</div>

			<div class="panel-footer no-border p-20">
				
				<div class="pull-right">
					<button type="button" id="postReviewBtn" class="media-right btn btn-default legitRipple">
						<i class="icon-share4 position-left"></i>
						<?php echo e(Lang::get('update_three.lang_post_review')); ?>

					</button>
				</div>

			</div>
		</div>
		<!-- /Reviews -->
		<?php endif; ?>

		<!-- Comments -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title text-semiold"><?php echo e(Lang::get('ads/show.lang_discussion')); ?></h6>
				<div class="heading-elements">
					<ul class="list-inline list-inline-separate heading-text text-muted">
						<li><?php echo e($total_comments + ($pinned_comment ? 1 : 0)); ?> <?php echo e(Lang::get('ads/show.lang_comment')); ?></li>
					</ul>
            	</div>
			</div>

			<div class="panel-body">

				<?php if($pinned_comment): ?>
				<ul class="media-list content-group-lg stack-media-on-mobile">
					<li class="media">
						<div class="media-left">
							<?php if(Profile::hasStore($pinned_comment->user_id)): ?>
							<a href="<?php echo e(Protocol::home()); ?>/store/<?php echo e(Profile::hasStore($pinned_comment->user_id)->username); ?>"><img data-src="<?php echo e(Profile::picture($pinned_comment->user_id)); ?>" class="lozad img-circle img-sm" alt="<?php echo e(Profile::hasStore($pinned_comment->user_id)->title); ?>"></a>
							<?php else: ?> 
							<a href="#"><img data-src="<?php echo e(Profile::picture($pinned_comment->user_id)); ?>" class="lozad img-circle img-sm" alt=""></a>
							<?php endif; ?>
						</div>

						<div class="media-body">
							<div class="media-heading">
								<a href="<?php echo e(Profile::hasStore($pinned_comment->user_id) ? Protocol::home().'/store/'.Profile::hasStore($pinned_comment->user_id)->username : '#'); ?>" class="<?php echo e(Profile::hasStore($pinned_comment->user_id) ? 'trusted-badge' : ''); ?> label label-primary label-rounded"><?php echo e(Profile::hasStore($pinned_comment->user_id) ? Profile::hasStore($pinned_comment->user_id)->title : Profile::full_name($pinned_comment->user_id)); ?></a>
								<span class="media-annotation dotted"><?php echo e(Helper::date_ago($pinned_comment->created_at)); ?></span>
								<?php if($pinned_comment->is_pinned): ?>
								<span class="media-annotation dotted text-black text-uppercase">Pinned</span>
								<?php endif; ?>
							</div>

							<p style="margin-top: 10px;" class="emojioneareaCm"><?php echo nl2br($pinned_comment->content); ?></p>

							<ul class="list-inline list-inline-separate text-size-small">

								<?php if(Auth::check()): ?>
								<?php if(Auth::id() == $pinned_comment->user_id): ?>
								<!-- Edit Comment -->
								<li><a href="<?php echo e(Protocol::home()); ?>/account/comments/edit/<?php echo e($pinned_comment->id); ?>">Edit</a></li>

								<!-- Delete Comment -->
								<li><a href="<?php echo e(Protocol::home()); ?>/account/comments/delete/<?php echo e($pinned_comment->id); ?>">Delete</a></li>
								<?php endif; ?>

								<li><a href="#" class="reportComment" data-comment-id="<?php echo e($pinned_comment->id); ?>">Report Abuse</a></li>

								<?php endif; ?>

							</ul>

						</div>
					</li>
					<hr>
				</ul>
				<?php endif; ?>

				<?php if(count($comments)): ?>
				<div id="commentScroll">

				    <ul class="media-list content-group-lg stack-media-on-mobile">

				    	<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				        <li class="media commentScroll">
							<div class="media-left">
								<?php if(Profile::hasStore($comment->user_id)): ?>
								<a href="<?php echo e(Protocol::home()); ?>/store/<?php echo e(Profile::hasStore($comment->user_id)->username); ?>"><img data-src="<?php echo e(Profile::picture($comment->user_id)); ?>" class="lozad img-circle img-sm" alt="<?php echo e(Profile::hasStore($comment->user_id)->title); ?>"></a>
								<?php else: ?> 
								<a href="#"><img data-src="<?php echo e(Profile::picture($comment->user_id)); ?>" class="lozad img-circle img-sm" alt=""></a>
								<?php endif; ?>
							</div>

							<div class="media-body">
								<div class="media-heading comments-heading">
									<a href="<?php echo e(Profile::hasStore($comment->user_id) ? Protocol::home().'/store/'.Profile::hasStore($comment->user_id)->username : '#'); ?>" class="<?php echo e(Profile::hasStore($comment->user_id) ? 'trusted-badge' : ''); ?> label label-primary label-rounded"><?php echo e(Profile::hasStore($comment->user_id) ? Profile::hasStore($comment->user_id)->title : Profile::full_name($comment->user_id)); ?></a>
									<span class="media-annotation dotted"><?php echo e(Helper::date_ago($comment->created_at)); ?></span>
									<?php if($comment->is_pinned): ?>
									<span class="media-annotation dotted text-black text-uppercase">Pinned</span>
									<?php endif; ?>
								</div>

								<p style="margin-top: 10px;" class="emojioneareaCm"><?php echo nl2br($comment->content); ?></p>

								<ul class="list-inline list-inline-separate text-size-small">

									<?php if(Auth::check()): ?>
									<?php if((Auth::id() === $ad->user_id) && (Auth::id() === $comment->user_id)): ?>

									<!-- Pin Comment -->
									<li><a class="pinComment" data-comment-id="<?php echo e($comment->id); ?>" data-ad-id="<?php echo e($ad->ad_id); ?>"><?php echo e(Lang::get('ads/show.lang_pin_comment')); ?></a></li>

									<?php endif; ?>

									<?php if(Auth::id() === $comment->user_id): ?>
									<!-- Edit Comment -->
									<li><a href="<?php echo e(Protocol::home()); ?>/account/comments/edit/<?php echo e($comment->id); ?>"><?php echo e(Lang::get('ads/show.lang_edit_comment')); ?></a></li>

									<!-- Delete Comment -->
									<li><a href="<?php echo e(Protocol::home()); ?>/account/comments/delete/<?php echo e($comment->id); ?>"><?php echo e(Lang::get('ads/show.lang_delete_comment')); ?></a></li>
									<?php endif; ?>

									<li><a href="#" class="reportComment" data-comment-id="<?php echo e($comment->id); ?>"><?php echo e(Lang::get('ads/show.lang_report_comment')); ?></a></li>

									<?php endif; ?>

								</ul>

							</div>
						</li>
						<hr>
				    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				    	<div style="display: none;">
					    	<?php echo e($comments->links()); ?>

					    </div>
				    
				    </ul>

				</div>
				<ul class="media-list content-group-lg stack-media-on-mobile">
					<div id="newComment"></div>
				</ul>
				<?php else: ?>
				<div id="hideNoCommentsNotice" class="alert bg-info alert-styled-left">
				<?php echo app('translator')->getFromJson('return/info.lang_no_comments_right_now'); ?>
		    	</div>
		    	<div id="newComment"></div>
				<?php endif; ?>

			</div>


			<div class="panel-body">
				<?php if(Auth::check()): ?>
				<p class="text-muted text-right-rtl"><?php echo e(Lang::get('ads/show.lang_add_comment_p')); ?></p>

				<form action="<?php echo e(Protocol::home()); ?>/comments/create" method="POST" id="createComment" data-ad-id="<?php echo e($ad->ad_id); ?>">
					
					<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

					<div class="content-group" id="spinnerDark">
						<textarea rows="5" cols="5" class="form-control" placeholder="<?php echo e(Lang::get('ads/show.lang_add_comment_placeholder')); ?>" name="comment" id="commentContent"></textarea>
					</div>
					
					<div class="text-right">
						<button type="submit" class="btn bg-blue" id="spinner-dark-6"><i id="spinnerIcon" style="display: none;" class="icon-spinner4 spinner position-left"></i> <?php echo e(Lang::get('ads/show.lang_add_comment_btn')); ?>

						</button>
					</div>

				</form>
				<?php else: ?> 
				<div class="alert bg-info alert-styled-left">
					<?php echo app('translator')->getFromJson('return/info.lang_login_or_register_to_add_comments'); ?>
			    </div>
				<?php endif; ?>

			</div>
		</div>
		<!-- /comments -->

	</div>

	<div class="col-md-3">

		<!-- Advertisements -->
		<?php if(Helper::ifCanSeeAds()): ?>
		<div class="advertisment">
			<?php echo Helper::advertisements()->ad_sidebar; ?>

		</div>
		<?php endif; ?>

		<!-- Usefull Information -->
		<div class="panel panel-flat">
			<div class="panel-body">
				<ul class="media-list">

					<li class="media">
						<div class="media-left">
							<a href="#" class="btn border-grey-300 text-grey-300 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark4"></i></a>
						</div>
						
						<div class="media-body">
							<?php echo e(Lang::get('ads/show.lang_safety_avoid_scams')); ?>

						</div>
					</li>

					<li class="media">
						<div class="media-left">
							<a href="#" class="btn border-grey-300 text-grey-300 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark4"></i></a>
						</div>
						
						<div class="media-body">
							<?php echo e(Lang::get('ads/show.lang_safety_never_pay')); ?>

						</div>
					</li>

					<li class="media">
						<div class="media-left">
							<a href="#" class="btn border-grey-300 text-grey-300 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark4"></i></a>
						</div>
						
						<div class="media-body">
							<?php echo e(Lang::get('ads/show.lang_safety_dont_buy')); ?>

						</div>
					</li>

					<li class="media">
						<div class="media-left">
							<a href="#" class="btn border-grey-300 text-grey-300 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark4"></i></a>
						</div>
						
						<div class="media-body">
							<?php echo e(Lang::get('ads/show.lang_safety_this_site_is_never')); ?>

						</div>
					</li>

				</ul>
			</div>
		</div>

		<!-- Advertisements -->
		<?php if(Helper::ifCanSeeAds()): ?>
		<div class="advertisment">
			<?php echo Helper::advertisements()->ad_sidebar; ?>

		</div>
		<?php endif; ?>

	</div>


</div>

<script type="text/javascript">
	
	document.getElementById ("postReviewBtn").addEventListener ("click", postR, false);

	/**
	* Send reviews
	*/
	function postR() {

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#reviewToken').attr('content')
            }
        });

		var _root   = $('#root').attr('data-root');
		
		// Get review comment
		var comment = document.getElementById('reviewComment').value;
		
		// Get review stars
		var stars   = document.querySelector('input[name="rating"]:checked').value;

		// Get ad id
		var ad_id   = document.getElementById('postID').value;

        $.ajax({
            type: "POST",
            url: _root + '/reviews/create',
            data: {
                comment: comment,
                stars: stars,
                ad_id: ad_id
            },
            success: function(response) {
                if (response.status == 'success') {
                    noty({
                        width: 200,
                        text: response.msg,
                        type: 'success',
                        dismissQueue: !0,
                        timeout: 4000,
                        layout: 'top'
                    })
                }
                if (response.status == 'error') {
                    noty({
                        width: 200,
                        text: response.msg,
                        type: 'error',
                        dismissQueue: !0,
                        timeout: 4000,
                        layout: 'top'
                    })
                }
                if (response.status == 'errors') {
                    var errorString = '<ul>';
                    $.each(response.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>'
                    });
                    errorString += '</ul>';
                    noty({
                        width: 200,
                        text: errorString,
                        type: 'error',
                        dismissQueue: !0,
                        timeout: 4000,
                        layout: 'top'
                    })
                }
            }
        })

	}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(Theme::get().'.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>