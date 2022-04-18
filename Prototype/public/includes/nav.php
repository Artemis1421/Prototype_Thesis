<link rel="stylesheet" href="../styles.css">

<style>
    .accordion-header {
    cursor: pointer;
    }

    .accordion-panel > .accordion-body {
    display: block;
    }

    .accordion-panel.accordion-expanded > .accordion-body {
    display: none;
    }
</style>

<div class="flex flex-col justify-between w-48 h-screen pl-8 pr-8 bg-gray-200">
    <div class="">
        <h1 class="mt-6 text-3xl font-bold tracking-wide text-left text-gray-900 ">Sagum Farms</h1>
    
        <nav>
            <h2 class="mt-6 text-xs font-semibold tracking-wide text-gray-600 uppercase ">Menu</h2>
            <div class="flex flex-col mt-2 space-y-2">
                <a
                class="font-semibold"
                href="../dashboard/dashboard.php">
                    <span>Dashboard</span></a>
                <!--Inventory-->
                <div class="accordion">
                    <button class="space-y-1 accordion-panel focus:outline-none" type="button">
                        <h1 class="font-semibold text-left accordion-header">Inventory</h1>
                        <div class="accordion-body">
                            <div class="flex flex-col pl-4 space-y-2 text-left">
                                <a 
                                href="../inventory/inventory.php">
                                    <span>Products</span></a>
                                <a 
                                href="../inventory/category.php">
                                    <span>Category</span></a>
                                <a 
                                href="../inventory/stocks.php">
                                    <span>Stocks</span></a>
                            </div>
                        </div>
                    </button>
                </div>
                <!--Sales-->
                <div class="accordion">
                    <button class="space-y-1 accordion-panel focus:outline-none" type="button">
                        <h1 class="font-semibold text-left accordion-header">Sales</h1>
                        <div class="accordion-body">
                            <div class="flex flex-col pl-4 space-y-1 text-left">
                                <a 
                                href="../sales/add_order.php">
                                    <span>Add Order</span></a>
                                <a 
                                href="../sales/orders.php">
                                    <span>All Orders</span></a>
                                <a 
                                href="../sales/sales.php">
                                    <span>Sales</span></a>
                            </div>
                        </div>
                    </button>
                </div>
                <!--Records-->
                <div class="accordion">
                    <button class="space-y-1 accordion-panel focus:outline-none" type="button">
                        <h1 class="font-semibold text-left accordion-header">Records</h1>
                        <div class="accordion-body">
                            <div class="flex flex-col pl-4 space-y-1 text-left">
                                <a 
                                href="../records/dailySales.php">
                                    <span>Daily Sales</span></a>
                                <a 
                                href="../records/logs.php">
                                    <span>Logs</span></a>
                            </div>
                        </div>
                    </button>
                </div>

            </div>
        </nav>
    </div>

    <div class="flex flex-col items-start mb-6 space-y-2">
        <button 
        type="button"
        class="">
            <a href="../users/settings.php">Settings</a>
        </button>

        <button 
        type="button"
        class="">
            <a href="../users/logout.php">Logout</a>
        </button>
    </div>
</div>

<script src="../js/dropdown.js"></script>