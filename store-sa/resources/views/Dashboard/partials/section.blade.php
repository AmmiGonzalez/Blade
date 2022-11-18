<div class="section row d-flex flex-column align-items-center w-100 mb-5 text-center">
  <div class="row">
    @foreach ($options as $option)
    {{-- {{print_r($option['cards'])}} --}}
    {{-- @foreach ($option['cards'] as $card)
    {{print_r($card['route'])}}
    @endforeach --}}
    <div class="col-lg-4 my-4">
      <h3 class="title py-2"><b>{{$option['title']}}</b></h3>
      <div class="options row justify-content-center">
        @foreach ($option['cards'] as $card)
          <a href="{{route($card['route'])}}" class="option col-lg-2 mt-3 mx-3 card" style="width: 10rem;">
            <div class="icon-container">
              <i class="fa-solid fa-{{$card['icon']}}"></i>
            </div>
            <div class="card-body">
              <h5 class="card-title"><b>{{$card['title']}}</b></h5>
            </div>
          </a>
        @endforeach
      </div>
    </div>
    @endforeach
  </div>
</div>