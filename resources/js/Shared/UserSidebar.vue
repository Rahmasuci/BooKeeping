<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <inertia-link :href="'/user'" class="brand-link">
            <span class="brand-text font-weight-light">BooKeeping</span>
        </inertia-link>

        <div class="sidebar"> 
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <inertia-link :href="'/user'" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('user.transactions.index')" class="nav-link">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>Transaction</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('user.page-report')" class="nav-link">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>Report</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('user.categories.index')"  class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Category</p>
                        </inertia-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>