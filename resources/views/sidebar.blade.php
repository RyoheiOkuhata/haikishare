

@if(Auth::guard('web')->user())
<aside class="l-sidebar">
  <li class="l-sidebar--list">
    <a href="{{route('users.index', ['id' => Auth::user()]) }}" class="c-sidebar">
      マイページTop

    </a>
  </li>
  <li class="l-sidebar--list">
    <a href="{{ route('products.create')}}" class="c-sidebar">
      商品を出品する

    </a>
  </li>
  <li class="l-sidebar--list">
    <a href="{{route('users.onSellProducts', ['id' => Auth::user()]) }}" class="c-sidebar">
      出品済の全商品

    </a>
  </li>
  <li class="l-sidebar--list">
    <a href="{{ route('users.soldProducts', ['id' => Auth::user()])}}" class="c-sidebar">
 売却済の全商品

    </a>
  </li>
  <li class="l-sidebar--list">
    <a href="{{route('users.profile', ['id' => Auth::user()])}}" class="c-sidebar">
      プロフィール

    </a>
  </li>
  <li class="l-sidebar--list">
    <a href="{{route('users.email.reset', ['id' => Auth::user()])}}" class="c-sidebar">
        メールアドレス

    </a>
  </li>
    <li class="l-sidebar--list">
    <a href="{{route('users.password.reset', ['id' => Auth::user()])}}" class="c-sidebar">
      パスワード
    </a>
  </li>


</aside>
@elseif (Auth::guard('buyers')->user())
<aside class="l-sidebar">

  <li class="l-sidebar--list">
    <a href="{{ route('buyers.index',['id' => Auth::guard('buyers')->user()])}}" class="c-sidebar">
      買った商品

    </a>
  </li> 
  <li class="l-sidebar--list">
    <a href="{{ route('buyers.profile',['id' => Auth::guard('buyers')->user()])}}" class="c-sidebar">
      プロフィール

    </a>
  </li>
    <li class="l-sidebar--list">
    <a href="{{ route('buyers.email.reset',['id' => Auth::guard('buyers')->user()])}}" class="c-sidebar">
      メールアドレス

    </a>
  </li>
    <li class="l-sidebar--list">
    <a href="{{ route('buyers.password.reset',['id' => Auth::guard('buyers')->user()])}}" class="c-sidebar">
      パスワード

    </a>
  </li>

  <li class="l-sidebar--list">
    <a class="c-sidebar" href="{{ route('buyer_auth.logout')}}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
     ログアウト </a>
   <form id="logout-form" action="{{ route('buyer_auth.logout')}}" method="POST" style="display:none;">
     @csrf
  </form>
  </li>

</aside>





@else

@endif
