<div>
    <div class="container-fluid">
        @include('livewire.alerts.alerts')
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header bg-light text-primary font-weight-bold">
                    <h6>
                        Settings
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model.defer="app_name" id="app_name" type="text"
                                           name="app_name" placeholder="app-name">
                                </div>
                                @error('app_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fa fa-envelope"></i></span></div>
                                    <input class="form-control" wire:model.defer="msg" id="msg" type="text"
                                           name="msg" placeholder="Message">
                                </div>
                                @error('msg')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fa fa-envelope"></i></span></div>
                                    <input class="form-control" wire:model.defer="url" id="url" type="text"
                                           name="url" placeholder="url">
                                </div>
                                @error('url')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fa fa-envelope"></i></span></div>
                                    <input class="form-control" wire:model.defer="version" id="version" type="text"
                                           name="version" placeholder="version">
                                </div>
                                @error('version')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked
                                       wire:model.defer="active">

                            </div>
                        </div>
                    </div>
                    <div class="form-group text-left mt-2">
                        <button class="btn btn-success text-white" wire:click="save"> Save <i class="fas fa-save"></i>
                            <span
                                wire:loading class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
