<!DOCTYPE html>
<html>

<head>
    <title><?php echo e(helper::appdata('')->web_title); ?></title>
    <style type="text/css">
        body {
            font-family: 'Roboto Condensed', sans-serif;
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center !important;
        }

        .w-100 {
            width: 100%;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #d2d2d2;
        }

        th {
            background-color: #F4F4F4;
            font-size: 15px;
            padding: 7px 8px;
        }

        td {
            font-size: 13px;
            padding: 7px 8px;
        }

        .header-title {
            margin-bottom: 20px;
        }

        .group-header {
            font-size: 18px;
            margin-top: 20px;
        }

        .city-list {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header-title">
        <h1 class="text-center"><?php echo e(trans('labels.city_list')); ?></h1>
    </div>

    <div class="table-section mt-10">
        <table class="table">
            <tbody>
                <?php
                    $groupedCities = $citieslist->groupBy('country_id');
                ?>

                <?php $__currentLoopData = $groupedCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryId => $citiesByCountry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th class="group-header">
                           
                            <?php echo e($citiesByCountry->first()->country_name); ?>

                        </th>
                        <th>
                            <?php echo e($citiesByCountry->first()->country_id); ?>

                            
                        </th>
                    </tr>
                    <?php $__currentLoopData = $citiesByCountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($city->city); ?>

                            </td>
                            <td>
                                <?php echo e($city->id); ?>

                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\matjarhub\resources\views\admin\import_vendor\citieslist.blade.php ENDPATH**/ ?>