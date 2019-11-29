<?php $__env->startSection('content'); ?>

<div class="row">
    
    <div class="col-md-12">
        
        <!-- Sessions Messages -->
        <?php if(Session::has('success')): ?>
        <div class="custom-alerts alert alert-success fade in">
            <?php echo e(Session::get('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
        <div class="custom-alerts alert alert-danger fade in">
            <?php echo e(Session::get('error')); ?>

        </div>
        <?php endif; ?>

        <div class="portlet light ">

            <div class="portlet-title tabbable-line">
                <div class="caption caption-md">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">رسائل المسؤول</span>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-hover table-outline m-b-0 hidden-sm-down">
                    <thead class="thead-default">
                        <tr>
                            <th class="text-center">الاسم كامل</th>
                            <th class="text-center">عنوان بريد الكتروني</th>
                            <th class="text-center">رقم الهاتف</th>
                            <th>موضوع</th>
                            <th class="text-center">تاريخ</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">خيارات</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($messages): ?>
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        
                            <!-- Sender Name -->
                            <td class="text-center text-muted">
                                <?php echo e($message->full_name); ?>

                            </td>

                            <!-- Sender Email -->
                            <td class="text-center text-muted">
                                <?php echo e($message->email); ?>

                            </td>

                            <!-- Sender Phone -->
                            <td class="text-center text-muted">
                                <?php echo e($message->phone); ?>

                            </td>

                            <!-- Message Subject -->
                            <td class="text-semibold">
                                <?php echo e($message->subject); ?>

                            </td>

                            <!-- Message Date -->
                            <td class="text-center text-muted">
                                <?php echo e(Helper::date_ago($message->created_at)); ?>

                            </td>

                            <!-- Message Status -->
                            <td class="text-center">
                                <?php if($message->is_read): ?>
                                <span class="badge badge-success badge-roundless"> مقروء </span>
                                <?php else: ?> 
                                <span class="badge badge-default badge-roundless"> غير مقروء </span>
                                <?php endif; ?>
                            </td>

                            <!-- Options -->
                            <td class="text-center">
                                <div class="btn-group">
                                    <i style="color: #405a72;font-size: 18px;cursor: pointer;" class="icon-settings dropdown-toggle" data-toggle="dropdown"></i>

                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="<?php echo e(Protocol::home()); ?>/dashboard/messages/admin/read/<?php echo e($message->id); ?>">
                                                <i class="glyphicon glyphicon-eye-open"></i> قراءة الرسالة</a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a style="color: #dd2c2c;text-transform: uppercase;" href="<?php echo e(Protocol::home()); ?>/dashboard/messages/admin/delete/<?php echo e($message->id); ?>">
                                                <i style="color: #dd2c2c;" class="glyphicon glyphicon-trash"></i> حذف رسالة</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </tbody>
                </table>

                <?php if($messages): ?>
                <div class="text-center">
                    <?php echo e($messages->links()); ?>

                </div>
                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>