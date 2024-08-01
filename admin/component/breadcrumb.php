<?php
function generateBreadcrumb($currentPath) {
    $breadcrumbs = [
        'dashboard' => ['Home', 'adminmainapp.php?unit=dashboard'],
        'gejala_unit' => ['Data Master', 'adminmainapp.php?unit=gejala_unit&act=datagrid'],
        'tentangpenyakit_unit' => ['Data tentang', 'adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid'],
        'dpb_unit'=> ['Basis Pengetahuan','adminmainapp.php?unit=dbp_unit&act=datagrid'],
    ];

    $breadcrumbItems = explode('/', trim($currentPath, '/'));
    $breadcrumbTrail = [];
    $path = '';

    foreach ($breadcrumbItems as $item) {
        if (array_key_exists($item, $breadcrumbs)) {
            $path .= '/' . $item;
            $breadcrumbTrail[] = [
                'label' => $breadcrumbs[$item][0],
                'link' => $breadcrumbs[$item][1]
            ];
        }
    }

    return $breadcrumbTrail;
}

// Example usage
$currentPath = $_GET['unit']; // Get the current unit from URL
$breadcrumbTrail = generateBreadcrumb($currentPath);
?>

<!-- Breadcrumb -->
<nav class="flex z-100" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <?php foreach ($breadcrumbTrail as $index => $breadcrumb): ?>
            <?php if ($index === count($breadcrumbTrail) - 1): ?>
                <li aria-current="page">
                    <div class="flex items-center">
                        <?php if ($index !== 0): ?>
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        <?php endif; ?>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                            <?php echo $breadcrumb['label']; ?>
                        </span>
                    </div>
                </li>
            <?php else: ?>
                <li class="inline-flex items-center">
                    <?php if ($index !== 0): ?>
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    <?php endif; ?>
                    <a href="<?php echo $breadcrumb['link']; ?>"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <?php echo $breadcrumb['label']; ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
<!-- End of Breadcrumb -->
