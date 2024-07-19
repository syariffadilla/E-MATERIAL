
@if (session('status'))
<div class="alert alert-{{ session('color')}} alert-dismissible fade show" role="alert">
    {{ session('status')}}
    <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
    
@endif