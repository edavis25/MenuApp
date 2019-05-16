<?php
/**
 * This partial displays a button & renders an attached modal containing the AddonGroup create/edit form
* @var App\AddonGroup|null $addon_group
* @var App\MenuItem        $menu_item
*/
/** @var string - The HTML ID needed for triggering modal (appends the object's ID for uniqueness) */
$modal_id = isset($addon_group->id) ? "addon-group-{$addon_group->id}" : "addon-group-new";
?>
@if (isset($addon_group->id))
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{ $modal_id }}">
        <i class="fa fa-pencil-alt"></i>
    </button>
@else
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{ $modal_id }}">
        <i class="fa fa-plus"></i> New Addon Group
    </button>
@endif


<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ isset($addon_group->id) ? "Editing: {$addon_group->name}" : "Create New Addon Group" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (isset($addon_group->id))
                {!! Form::model($addon_group, ['route' => ['admin.addon-group.update', $addon_group->id], 'method' => 'PUT']) !!}
            @else
                {!! Form::open(['route' => ['admin.addon-group.store', $menu_item->id], 'method' => 'POST']) !!}
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        Name
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Description:<br>
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </label>
                </div>
                <div class="form-group form-check">
                    {!! Form::checkbox('required', null, isset($addon_group->id) ? $addon_group->required ? true : false : false) !!}
                    <label class="form-check-label">Required?</label>
                    <small class="form-text text-muted">Required groups force user to make a selection</small>
                </div>
                <div class="form-group form-check">
                    {!! Form::checkbox('exclusive', null, isset($addon_group->id) ? $addon_group->exclusive ? true : false : false) !!}
                    <label class="form-check-label">Exclusive?</label>
                    <small class="form-text text-muted">Exclusive groups allow only 1 single selection</small>
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
