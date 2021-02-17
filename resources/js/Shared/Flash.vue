<template>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">

        </div>

        <div class="col-md-4 col-sm-6 ">
            <div class="card bg-success" v-if="$page.props.flash.message">
                <div class="card-header">
                    <h3 class="card-title">Notification</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <center>{{ $page.props.flash.message }}</center>                                
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            
        </div>
    </div>
</template>
