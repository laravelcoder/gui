<template>
    @if (Auth::guest())
    @else
    @php
        $user = Auth::user();
    @endphp
              <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            @if($user->getFirstMediaUrl('avatar')))
             <img src="{{ @$user->getFirstMediaUrl('avatar') }}" class=" " alt="User Image" onError="this.src='//placeholdit.imgix.net/~text?txtfont=monospace,bold&bg=DD4B39&txtclr=ffffff&txt=A&w=45&h=45&txtsize=16'">
            @elseif(Gravatar::exists(Auth::user()->email))
                <img src="{{ Gravatar::src(Auth::user()->email) }}" class="" alt="User Image"/>
            @else
                <img src="https://placehold.it/150x150" class="" alt="User Image"/>
            @endif
            </div>
            <div class="pull-left info">
              <p><a href="{{ route('admin.profile') }}">{{ Auth::user()->name }}</a></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
    @endif
    <br style="clear:both" />
</template>

<script>
    export default {
    props: ['user'],
    
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
