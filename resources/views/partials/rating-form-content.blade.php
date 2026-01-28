<div class="evaluation-card p-4 text-white" dir="rtl">
    <form wire:submit.prevent="saveEvaluation">
        <div class="text-center mb-md-4">
            <h6 class="fw-bold mb-2">الهدف من هذا التقييم هو دعم تعلمك وضمان بناء معرفتك بشكل تدريجي وسليم.</h6>
            <p class="text-third small fs-7">المرجو وضع علامة في الخانة الملائمة لتقييمكم:</p>
        </div>

        @if (session()->has('message'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
        </div>
        @endif

        <div class="questions-container mb-md-5">
            @php
            $questions = [
            ['id' => 'manual_steps_respect', 'title' => 'تم احترام خطوات دليل الاستعمال', 'options' => ['fully','partially','not_at_all']],
            ['id' => 'focus_and_memory', 'title' => 'تقوية التركيز والانتباه والذاكرة', 'options' => ['good','average','weak']],
            ['id' => 'family_involvement', 'title' => 'انخراط أفراد الأسرة', 'options' => ['good','average','weak']],
            ['id' => 'motor_and_emotional_stability', 'title' => 'الثبات الحركي والانفعالي', 'options' => ['good','average','weak']],
            ['id' => 'enjoyment', 'title' => 'تحقيق المتعة والترفيه', 'options' => ['good','average','weak']],
            ['id' => 'digital_addiction_avoidance', 'title' => 'تجنب الإدمان الإلكتروني', 'options' => ['fully','partially','not_at_all']],
            ['id' => 'challenge_and_persistence', 'title' => 'تحقيق التحدي والمثابرة', 'options' => ['good','average','weak']],
            ['id' => 'attached_docs_usage', 'title' => 'تم استعمال الوثائق المرفقة', 'options' => ['fully','partially','not_at_all']],
            ];
            @endphp

            @foreach($questions as $q)
            <div class="question-row d-md-flex align-items-center justify-content-between">
                <p class="mb-2 mb-md-0 fw-bold">{{ $q['title'] }}</p>
                <div class="rating-group">
                    @foreach($q['options'] as $opt)
                    <div class="rating-item">
                        <input type="radio" wire:model="{{ $q['id'] }}" value="{{ $opt }}" id="{{ $q['id'] . $opt }}">
                        <label for="{{ $q['id'] . $opt }}">{{ __('neuralbox.'.$opt) }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            @error($q['id']) <small class="text-danger">{{ $message }}</small> @enderror
            @endforeach
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label small text-white">إيجابيات اللعبة</label>
                <textarea class="form-control text-white border-purple" wire:model="game_strengths" rows="2" placeholder="ما الذي أعجبك؟"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label small text-white">النتائج الملحوظة</label>
                <textarea class="form-control text-white border-secondary" wire:model="observed_results" rows="2" placeholder="ما هي التغييرات التي لاحظتها؟"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label small text-white">الصعوبات</label>
                <textarea class="form-control text-white border-secondary" wire:model="difficulties" rows="2" placeholder="اكتب الصعوبات ..."></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label small text-white">إضافات وملاحظات عامة</label>
                <textarea class="form-control text-white border-secondary" wire:model="general_notes" rows="2" placeholder="اكتب أي ملاحظات أخرى هنا..."></textarea>
            </div>
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary text-white btn-lg px-md-5 fs-7 rounded-pill shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="saveEvaluation">إرسال </span>
                <span wire:loading wire:target="saveEvaluation">
                    <span class="spinner-border spinner-border-sm me-2"></span> جاري الإرسال...
                </span>
            </button>
        </div>
    </form>
</div>