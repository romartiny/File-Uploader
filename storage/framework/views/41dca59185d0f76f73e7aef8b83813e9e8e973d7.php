<?php $__env->startSection('title'); ?>
    FileUpload
<?php $__env->stopSection(); ?>
<body>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <a href="logout" class="logout-link">Logout</a>
                    <h1 class="text-center">FileUpload</h1>
                    <form action="<?php echo e(route('dashboard')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="action" value="add" required>
                        <div class="block-send">
                            <input class="input-file" type="file" name="file" id="file" onchange="validateSize(this)"
                                   accept=".jpg, .png, .jpeg, .txt" required>
                            <div class="button-block">
                                <button type="submit" value="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="block__results">
                        <div class="results">
                            <?php if(isset($fileNames)): ?>
                                <?php $__currentLoopData = $fileNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p> Name: <?php echo e($file); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p>No files</p>
                            <?php endif; ?>
                        </div>
                        <div class="file__block">
                            <ul class="file__block-list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/js/app.js"></script>
</body>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/romartiny/Documents/GitHub/LaraFileUpload/resources/views/upload.blade.php ENDPATH**/ ?>