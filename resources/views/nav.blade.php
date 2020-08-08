<!---------------------------header------------------------------>
<header class="l-header">
  <div class="c-header">
    <a class="p-logo" href="{{ route('products.index')}}">Haiki</a>
    @if(Auth::guard('web')->user())
    <nav class="nav">
      <ul class="menu">
         <li class="p-menu--item">
           <a href="{{ route('users.index',['id' => Auth::user('web')])}}" class="u-font--color_sub">マイページ</a>
          <ul class="sub">
            <li class="p-menu--item">
              <a href="{{ route('products.create')}}" class="p-menu--list">
                出品する
                </a>
            </li>
            <li class="p-menu--item">
              <a class="p-menu--list" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
               ログアウト
               </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
               @csrf
              </form>
           </li>
          </ul>
        </li>
     </ul>
    </nav>
<!-- -------------------------sp-nav------------------------------>
<nav class="p-header--nav js-toggle-sp-menu-target">
  <ul class="p-nav js-toggle-close">
      <li class="p-nav--item">
     <a href="{{ route('products.index')}}" class="p-nav--link">
      マイページTop
      </a>
    </li>
    <li class="p-nav--item">
     <a href="{{ route('products.create')}}" class="p-nav--link">
      商品を出品する
       </a>
    </li>
    <li class="p-nav--item">
     <a href="{{route('users.onSellProducts', ['product_id' => Auth::user( 'web')]) }}" class="p-nav--link">
      出品済の商品一覧
       </a>
    </li>
    <li class="p-nav--item">
     <a href="{{ route('users.soldProducts', ['product_id' => Auth::user()])}}"  class="p-nav--link">
        売却済の全商品
       </a>
    </li>
      <li class="p-nav--item">
     <a href="{{route('users.profile', ['id' => Auth::user('web')])}}" class="p-nav--link">
      プロフィール
       </a>
    </li>
        <li class="p-nav--item">
     <a href="{{route('users.email.reset', ['id' => Auth::user()])}}" class="p-nav--link">
        メールアドレス
       </a>
    </li>
        <li class="p-nav--item">
     <a href="{{route('users.password.reset', ['id' => Auth::user()])}}" class="p-nav--link">
      パスワード
       </a>
    </li>
   <li class="p-nav--item">

       <a class="p-nav--link" href="{{ route('buyer_auth.logout')}}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
     ログアウト </a>


    </li>
  </ul>
</nav>
<!-- --------------------------sp-nav-------------------------------->

    @elseif (Auth::guard('buyers')->user())
    <nav class="nav ">
      <ul class="menu">
         <li class="p-menu--item">
          <a href="{{ route('buyers.index',['id' =>Auth::guard('buyers')->user()])}}" class="u-font--color_sub">マイページ</a>
          <ul class="sub">
            <li class="p-menu--item">
              <a href="{{ route('buyers.show',['id' =>Auth::guard('buyers')->user()])}}" class="u-font--color_sub">プロフィール</a>
            </li>
            <li class="p-menu--item">
              <a class="p-menu--item" href="{{ route('buyer_auth.logout')}}"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
               ログアウト </a>
             <form id="logout-form" action="{{ route('buyer_auth.logout')}}" method="POST" style="display:none;">
               @csrf
            </form>
           </li>
          </ul>
        </li>
     </ul>
    </nav>

<!---------------------------sp-nav------------------------------>
<nav class="p-header--nav js-toggle-sp-menu-target">
  <ul class="p-nav js-toggle-close">
    <li class="p-nav--item">
     <a href="{{ route('buyers.index',['id' =>Auth::guard('buyers')->user()])}}" class="p-nav--link">
          購入済商品一覧
                <i class="fas fa-chevron-right"></i>
       </a>
    </li>
      <li class="p-nav--item">
     <a href="{{ route('buyers.show',['product_id' => Auth::guard('buyers')->user()])}}"class="p-nav--link">

          プロフィール編集
                <i class="fas fa-chevron-right"></i>
       </a>
    </li>

      <li class="p-nav--item">
     <a href="{{ route('buyers.email.reset',['product_id' => Auth::guard('buyers')->user()])}}" class="p-nav--link">
          メールアドレス変更
                <i class="fas fa-chevron-right"></i>
       </a>
    </li>
        <li class="p-nav--item">
     <a href="{{ route('buyers.password.reset',['product_id' => Auth::guard('buyers')->user()])}}" class="p-nav--link">
          パスワード変更
                <i class="fas fa-chevron-right"></i>
       </a>
    </li>
    <li class="p-nav--item">
     <a class="p-nav--link" href="{{ route('buyer_auth.logout')}}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
     ログアウト
           <i class="fas fa-chevron-right"></i>
     </a>

    <form id="logout-form" action="{{ route('buyer_auth.logout')}}" method="POST" style="display:none;">
     @csrf
  </form>
    </li>
    </li>
  </ul>
</nav>
<!-- --------------------------sp-nav-------------------------------->



    @else
    <nav class="nav">
      <ul class="menu">
         <li class="p-menu--item u-line">
          新規登録
            <ul class="sub">
              <li class="p-menu--item">
                <a href="{{ route('register') }}" class="p-menu--list">
                コンビニの方</a>
              </li>
              <li class="p-menu--item">
                <a href="{{ route('buyer_auth.register') }}" class="p-menu--list">購入する方</a>
              </li>
            </ul>
        </li>
        <li class="p-menu--item u-line">
         ログイン
            <ul class="sub">
              <li class="p-menu--item ">
                <a href="{{ route('login') }}" class="p-menu--list">
                  コンビニの方</a>
              </li>
              <li class="p-menu--item">
                <a href="{{ route('buyer_auth.login') }}" class="p-menu--list">購入する方</a>
              </li>
            </ul>
         </li>
     </ul>
    </nav>

<!--------sp-nav--------->
<nav class="p-header--nav js-toggle-sp-menu-target">
  <ul class="p-nav js-toggle-close">
    <li class="p-nav--item p-nav--title">コンビニの方</li>

     <li class="p-nav--item">
     <a href="{{ route('register') }}" class="p-nav--link">
          新規登録
               <i class="fas fa-chevron-right"></i>
       </a>
    </li>

      <li class="p-nav--item">
     <a href="{{ route('login') }}" class="p-nav--link">
          ログイン
               <i class="fas fa-chevron-right"></i>
       </a>
    </li>
      <li class="p-nav--item p-nav--title">購入する方</li>

     <li class="p-nav--item">
     <a href="{{ route('buyer_auth.register') }}" class="p-nav--link">
          新規登録
               <i class="fas fa-chevron-right"></i>
       </a>
    </li>
     <li class="p-nav--item">
     <a href="{{ route('buyer_auth.login') }}" class="p-nav--link">
          ログイン
               <i class="fas fa-chevron-right"></i>
       </a>
    </li>
  </ul>
</nav>
<!-- --------------------------sp-nav-------------------------------->
    @endif
    <div class="bars-trigger js-toggle-sp-menu">
      <span class="bars">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </span>
    </div>
  </div>
</header>
<!-- -------------------------header------------------------------->




