<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <inertia-link :href="'/admin'" class="brand-link">
            <span class="brand-text font-weight-light">BooKeeping</span>
        </inertia-link>

        <div class="sidebar"> 
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <inertia-link :href="'/admin'" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('admin.transactions.index')" class="nav-link">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>Transaction</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('admin.categories.index')" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Category</p>
                        </inertia-link>
                    </li> 
                    <li class="nav-item">
                        <inertia-link :href="$route('admin.users')" class="nav-link">
                            <i class="nav-icon fas fa-users "></i>
                            <p>User</p>
                        </inertia-link>
                    </li> 
                    <!-- <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Category
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-minus-square nav-icon"></i>
                                    <p>Spending</p>
                                </a>
                            </li>
                        </ul>
                    </li>            -->
                </ul>
            </nav>
        </div>
    </aside>
</template>