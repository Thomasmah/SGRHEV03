<!-- Modal de sessão expirada -->
<div class="modal fade" id="sessionExpiredModal" tabindex="-1" role="dialog" aria-labelledby="sessionExpiredModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionExpiredModalLabel">Sessão Expirada</h5>
            </div>
            <div class="modal-body">
                Sua sessão expirou. Faça login novamente.
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ route('logout') }}" x-data>
              @csrf
              <x-dropdown-link href="{{ route('logout') }}"
                @click.prevent="$root.submit();">
                <button class="btn btn-primary">Logar</button>
              </x-dropdown-link>
            </form>
            </div>
        </div>
    </div>
</div>