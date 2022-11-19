@if (session()->has('cart'))
<div class="cartIndicator">
  <div class="indicator">
    <p>
      @if (count(session()->get('cart')) > 9)
        +9
      @else {{count(session()->get('cart'))}}
      @endif
    </p>
  </div>
</div>
@endif