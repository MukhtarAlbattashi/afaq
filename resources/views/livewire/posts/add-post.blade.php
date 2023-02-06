<div>
    <div class="container-fluid">
        @include('livewire.alerts.alerts')
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header bg-light text-primary font-weight-bold">
                    <h6>
                        Add New Post
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model.lazy="title" id="title" type="text" name="title" placeholder="title">
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model="slug" id="slug" type="text" name="slug" placeholder="slug" disabled>
                                </div>
                                @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model.defer="tags" id="title" type="text" name="tags" placeholder="tags">
                                </div>
                                @error('tags')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i class="fas fa-heading"></i></span></div>
                                    <input class="form-control" wire:model.defer="preview" id="preview" type="text" name="preview" placeholder="preview">
                                </div>
                                @error('preview')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select wire:model="theme" class="form-control">
                                @foreach(Markdom::getAvailableThemes() as $style)
                                <option value="{{$style}}">{{$style}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text"><span class="input-group-text"><i class="fa fa-file"></i></span></div>
                                    <input class="form-control" wire:model.defer="photo" id="photo" type="file" name="photo">
                                </div>
                                @error('photo')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" width="60" height="60" alt="img">
                            @endif
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea dir="rtl" class="form-control" wire:model.debounce.2000ms="markdown" id="markdown" name="markdown" rows="20">
                                    </textarea>
                                </div>
                                @error('markdown')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" dir="rtl">
                            @markdomStyles($theme)
                            @markdom($markdown)
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success text-white" wire:click="save"> Save <i class="fas fa-save"></i>
                            <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>