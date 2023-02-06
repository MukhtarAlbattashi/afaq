<div>
    <div class="container-fluid">
        @include('livewire.alerts.alerts')
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header bg-light text-primary font-weight-bold">
                    <h6>
                        Add New Card
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model.defer="name" id="name" type="text"
                                           name="name" placeholder="name">
                                </div>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fa fa-coins"></i></span></div>
                                    <input class="form-control" wire:model.defer="coins" id="coins" type="number"
                                           name="coins" placeholder="coins">
                                </div>
                                @error('coins')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i
                                                class="fa fa-file"></i></span></div>
                                    <input class="form-control" wire:model.defer="photo" id="photo" type="file"
                                           name="photo">
                                </div>
                                @error('photo')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Available</label>
                                <input class="form-check-input" wire:model.defer="available" type="checkbox"
                                       id="flexSwitchCheckDefault">
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" width="150" height="150" alt="img">
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center">
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
