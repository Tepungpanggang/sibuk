<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        h1 { font-size: 16px; }
    </style>
</head>
<body>
    <h1>Laporan Transaksi Peminjaman</h1>
    <p>Dicetak pada: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Siswa</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>#<?php echo e($loan->id); ?></td>
                    <td><?php echo e($loan->user->name); ?></td>
                    <td><?php echo e($loan->book->title); ?></td>
                    <td><?php echo e($loan->loan_date->format('d/m/Y')); ?></td>
                    <td><?php echo e($loan->returned_at?->format('d/m/Y') ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($loan->status)); ?></td>
                    <td>Rp <?php echo e(number_format($loan->fine->amount ?? 0, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH D:\Tugas\sibuk\resources\views/admin/reports/print.blade.php ENDPATH**/ ?>