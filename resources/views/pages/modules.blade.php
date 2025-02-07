<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules</title>
    @include('core.core_css')

    @livewireStyles
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <x-nav />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <x-sidenav />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <h4>Module Management</h4>
                        <div class="col-sm-12 mb-4">
                            <button class="btn btn-sm btn-primary float-end" id="btn_add"
                                data-bs-toggle="modal"
                                onclick="triggerLivewireEvent()"
                                data-bs-target="#modal">Create Module</button>
                        </div>

                        <livewire:components.modules-card />

                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- Modal component -->
    <x-modal id="modal" title="Module">
        <livewire:forms.moduleform />
    </x-modal>

    <x-modal id="delete_modal" title="Prompt">
        <livewire:components.deleteprompt />
    </x-modal>
</body>
@include('core.core_js')


<script>
    function triggerLivewireEvent() {
        Livewire.dispatch('show-modal', {
            id: null,
            action: 'Add'
        });
    }
</script>


@livewireScripts

@scripts

</html>