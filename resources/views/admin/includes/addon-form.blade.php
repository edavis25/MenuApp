<?php
/**
 * This partial displays a button & renders an attached modal containing the Addon create/edit form
 * @var App\AddonGroup  $addon_group
 * @var App\Addon|null  $addon
 */

/** @var string - The HTML ID needed for triggering modal (appends the object's ID for uniqueness) */
$modal_id = isset($addon->id) ? "addon-{$addon->id}" : "addon-new";
?>

@if (isset($addon->id))
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{ $modal_id }}">
        <i class="fa fa-pencil-alt"></i>
    </button>
@else
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{ $modal_id }}">
        <i class="fa fa-plus"></i> New Addon
    </button>
@endif

<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ isset($addon->id) ? "Editing: {$addon->name}" : "Create New Addon" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (isset($addon->id))
                {!! Form::model($addon, ['url' => route('admin.addon.update', $addon->id), 'method' => 'PUT']) !!}
            @else
                {!! Form::open(['route' => ['admin.addon.store', $addon_group->id], 'method' => 'POST']) !!}
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        Name:
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Additional Price:<br>
                        {!! Form::number('price', isset($addon->price) ? $addon->price / 100 : 0, ['class' => 'form-control', 'step' => 0.01]) !!}
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

