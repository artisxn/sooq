<?php $__env->startSection('content'); ?>

<div class="row">
    
    <div class="col-md-12">

        <div class="profile-sidebar">

            <div class="portlet light profile-sidebar-portlet ">

                <div class="profile-userpic">
                    <img src="<?php echo e(Profile::picture($user->id)); ?>" class="img-responsive" alt="<?php echo e($user->username); ?>"> </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </div>
                    <div class="profile-usertitle-job"> <?php echo e($user->username); ?> </div>
                </div>

                <div class="profile-userbuttons" style="padding-bottom: 30px;">
                    <?php if(Profile::hasStore($user->id)): ?>
                    <a href="<?php echo e(Protocol::home()); ?>/store/<?php echo e(Profile::hasStore($user->id)->username); ?>" class="btn btn-circle green btn-sm">View Store</a>
                    <?php endif; ?>
                    <a href="<?php echo e(Protocol::home()); ?>/dashboard/users/edit/<?php echo e($user->username); ?>" class="btn btn-circle red btn-sm">Edit Profile</a>
                </div>

            </div>

            <div class="portlet light ">

                <div class="row list-separated profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> <?php echo e($ads_today); ?> </div>
                        <div class="uppercase profile-stat-text"> Ads Today </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> <?php echo e($ads_month); ?> </div>
                        <div class="uppercase profile-stat-text"> Month </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> <?php echo e($ads_year); ?> </div>
                        <div class="uppercase profile-stat-text"> Year </div>
                    </div>
                </div>

                <div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-globe"></i>
                        <a href="#"><?php echo e(Countries::country_name($user->country_code)); ?></a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <?php if($user->gender): ?>
                        <i class="fa fa-mars"></i>
                        <a href="#">ولد</a>
                        <?php else: ?> 
                        <i class="fa fa-venus"></i>
                        <a href="#">بنت</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                        </div>
                        <div class="portlet-body">

                            <!-- Email Address -->
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-circle-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control input-circle-right" placeholder="Email Address" value="<?php echo e($user->email); ?>" disabled=""> 
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-circle-left">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" class="form-control input-circle-right" placeholder="Phone Number" value="<?php echo e($user->phone); ?>" disabled=""> 
                                </div>
                            </div>

                            <!-- State Name -->
                            <div class="form-group">
                                <label>اسم الشارع</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-circle-left">
                                        <i class="fa fa-map"></i>
                                    </span>
                                    <input type="text" class="form-control input-circle-right" placeholder="State Name" value="<?php echo e(Countries::state_name($user->state)); ?>" disabled=""> 
                                </div>
                            </div>

                            <!-- City Name -->
                            <div class="form-group">
                                <label>اسم المدينة</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-circle-left">
                                        <i class="fa fa-map"></i>
                                    </span>
                                    <input type="text" class="form-control input-circle-right" placeholder="City Name" value="<?php echo e(Countries::city_name($user->city)); ?>" disabled=""> 
                                </div>
                            </div>

                            <!-- Last Login IP -->
                            <div class="form-group">
                                <label>Last Login IP</label>
                                <div class="input-group">
                                    <span class="input-group-addon input-circle-left">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" class="form-control input-circle-right" placeholder="Last Login IP" value="<?php echo e($user->last_login_ip); ?>" disabled=""> 
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>