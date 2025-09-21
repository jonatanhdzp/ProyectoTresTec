@props(['id', 'color' => 'warning', 'title' => 'Editar', 'action', 'method' => 'POST', 'fields' => []])

<div class="dropdown dropdown-lg">
    <button class="btn btn-{{ $color }} dropdown-toggle" type="button" id="dropdownMenuButton{{ $id }}"
        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        {{ $title }}
    </button>
    <div class="dropdown-menu p-3 shadow-lg dropdownForm" aria-labelledby="dropdownMenuButton{{ $id }}">
        <form action="{{ $action }}" method="POST" class="row g-2">
            @csrf

            @if (strtoupper($method) !== 'POST')
                @method($method)
            @endif

            <div class="row">
                @foreach ($fields as $field)
                    @php
                        $field['required'] = $field['required'] ?? false;
                    @endphp
                    <div class="col-12 mb-2">
                        <label class="form-label">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                            class="form-control form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name']) ?? $field['value'] ?? '' }}" {{ $field['required'] ? "required" : ""}}>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
            </div>
        </form>
    </div>
</div>
