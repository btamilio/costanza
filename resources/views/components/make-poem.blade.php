<div class="row card">
    <div class="card-body poetry-input rounded">
        <form method="POST" action="/poem/make">

            @csrf

            @foreach ($feature_types as $type)
            <div class="row">
                <div class="col-3 pt-1  fs-6  text-end">{{ $type["label"] ?? $type["name"] }}:</div>
                <div class="col-9 text-start text-nowrap  align-middle">
                    <select class="form-select mb-3 text-capitalize  rounded" name="{{ $type['name'] }}">
                        <option selected value="">¯\_(ツ)_/¯</option>
                        @foreach ($type["features"] as $feature)
                        <option value="{{ $feature['id'] }}">{{ ucfirst($feature['label'] ?? $feature['name']) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach

            <div class="row ">
                <div class="col text-end pt-1  fs-6 align-top ">Topic:</div>
                <div class="col-9 text-start">
                    <textarea class="form-control mb-3 text-start rounded" name="topic" rows="3" maxlength="300"
                        placeholder="¯\_(ツ)_/¯"></textarea>
        
                </div>
            </div>

            <div class="row">
                <div class="col text-start"></div>
                <div class="col-9">
                    <div class="d-grid gap-2  text-end">
                        <button type="submit"
                            class="btn btn-lg btn-success text-nowrap text-center placeholder-wave">Make Poem!</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>