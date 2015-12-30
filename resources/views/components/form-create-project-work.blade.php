{{-- $project, $csrfToken --}}
<div id="form-create-project-work" data-action="{{ route('projects.works.store', $project->id) }}" data-csrf-token="{{ $csrfToken }}"></div>
