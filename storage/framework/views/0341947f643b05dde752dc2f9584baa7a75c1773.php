<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="table">
    <div class="clearfix mb-2">
        <div class="float-left">
            <form method="GET" class="form-inline">
            <div class="form-group">
                <label for="limit" class="sr-only">Limit</label>
                <select name="limit" class="form-control" id="limit">
                    <?php
                        $limits = [5, 10, 15, 20];
                    ?>
                    <?php for($i=0; $i < count($limits); $i++ ): ?>
                        <?php
                            $sel = $limits[$i] == $limit ? 'select="1"' : '';
                        ?>
                    <option <?php echo e($sel); ?> value="<?php echo e($limits[$i]); ?>"><?php echo e($limits[$i]); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
                <div class="form-group">
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="ค้นหา ชื่อสินค้า" value="<?php echo e(!empty($_GET['search']) ? $_GET['search'] : ''); ?>">
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <a href="<?php echo e(url('type/create')); ?>" class="btn btn-primary float-right">เพิ่มข้อมูล</a>
    </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr style="text-align:center;">
                    <th scope="col">#</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $Number = 0;
                    $first = 1 ;
                    $last = $limit < count($data) ? $limit : count($data); 
                ?> 

                <?php if( $data->currentPage() > 1): ?>
                    <?php
                        $Number = $limit * ($data->currentPage() - 1);
                        $first = $limit * ($data->currentPage()-1) + 1;
                        $last = $first + ($limit-1);
                    ?>
                    
                <?php if( $last >= $data->total()): ?>
                    <?php
                        $last = $data->total();
                    ?>

                <?php endif; ?>
                    
                <?php endif; ?>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th align="center"><?php echo e($Number + $loop->iteration); ?></th>
                        <td align="center"><?php echo e($value->name); ?></td>
                        <td align="center"><a href="<?php echo e(action('ProductTypeController@edit',$value->id)); ?>"
                                class="btn btn-secondary">แก้ไข</a>
                            <a href="<?php echo e(action('ProductTypeController@delete',$value->id)); ?>" class="btn btn-danger"
                                onclick="return confirm('ลบเหอะ')"> ลบ </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th colpan="5">แสดงข้อมูลจำนวน <?php echo e($first); ?> ถึง <?php echo e($last); ?> จาก <?php echo e($data->total()); ?> รายการ </th>
                </tr>
            </tfoot>
        </table>
        <?php echo e($data->appends(request()->query())->links()); ?>

        
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>