@extends('layouts.admin')

@section('content')


<div class="md:p-6 bg-gray-50 min-h-screen">
    <h1 class=" mb-6 md:text-xl justify-center md:justify-start text-sm flex items-center gap-2">Avis: de <span class="md:text-3xl text-base font-extrabold  text-indigo-700">{{ $review->user->name }}</span></h1>
    <div class="md:p-5 w-full overflow-x-auto ms-auto" dir="rtl">
        <div class="md:ms-auto bg-white w-fit rounded-lg shadow-md md:p-4 border-t-4 border-blue-500 flex items-center transition-all duration-300 hover:shadow-lg hover:translate-y-[-2px]">
            <div>
                <div class="md:p-4 sm:p-6 bg-gray-50 shadow-md rounded-lg">
                    <div class="mb-4 ">
                        <div class="overflow-x-auto mb-6">
                        <table  class=" text-xs min-w-full border border-gray-300 divide-y divide-gray-300">
                            <thead class="bg-gray-200">
                                <tr >
                                    <th class="md:px-3 p-1  md:py-2 border-l border-gray-300 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">التقييم</th>
                                    <th class="md:px-3 p-1  md:py-2 border-l border-gray-300 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">درجة الرضا</th>
                                    <th class="md:px-3 p-1  md:py-2 border-l border-gray-300 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">التقييم</th>
                                    <th class="md:px-3 p-1  md:py-2 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">درجة الرضا</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" >
                                <tr class="bg-white" >
                                    <td class="md:px-3 p-1 md:py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تم احترام خطوات دليل الاستعمال</td>
                                    <td class="md:px-3 p-1 md:py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['fully','partially','not_at_all'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="manual_steps_respect" disabled {{ $val == $review->manual_steps_respect ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="md:px-3 p-1 md:py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تقوية التركيز والانتباه والذاكرة</td>
                                    <td class="md:px-3 p-1 md:py-3  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['good','average','weak'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="focus_and_memory" disabled {{ $val == $review->focus_and_memory ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="bg-white">
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">انخراط أفراد الأسرة</td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['good','average','weak'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="family_involvement" disabled {{ $val == $review->family_involvement ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">الثبات الحركي والانفعالي</td>
                                    <td class="px-3 py-3  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['good','average','weak'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="motor_and_emotional_stability" disabled {{ $val == $review->motor_and_emotional_stability ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="bg-white">
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تحقيق المتعة والترفيه</td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['good','average','weak'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="enjoyment" disabled {{ $val == $review->enjoyment ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تجنب الإدمان الإلكتروني</td>
                                    <td class="px-3 py-3  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['fully','partially','not_at_all'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="digital_addiction_avoidance" disabled {{ $val == $review->digital_addiction_avoidance ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="bg-white">
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تحقيق التحدي والمثابرة</td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['good','average','weak'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="challenge_and_persistence" disabled {{ $val == $review->challenge_and_persistence ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td class="px-3 py-3 border-l border-gray-300  text-gray-800 text-center whitespace-nowrap">تم استعمال الوثائق المرفقة</td>
                                    <td class="px-3 py-3  text-gray-800 text-center whitespace-nowrap">
                                        @foreach(['fully','partially','not_at_all'] as $val)
                                        <div class="inline-flex items-center mx-2 rtl:mr-0 rtl:ml-2">
                                            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" required name="attached_docs_usage" disabled {{ $val == $review->attached_docs_usage ? "checked" : "" }} value="{{ $val }}">
                                            <label class="ms-1  font-medium text-gray-900 rtl:ml-0 rtl:mr-1">{{ __('neuralbox.'.$val) }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-4">
                        <label class="md:text-base md:mb-3 block  font-bold text-gray-700 mb-1">إيجابيات اللعبة:</label>
                        <textarea disabled  class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed" name="game_strengths" rows="3" value={{ $review->game_strengths }}></textarea>
                        </div>

                    <div class="mb-4">
                        <label class="md:text-base md:mb-3 block  font-bold text-gray-700 mb-1">النتائج الملحوظة:</label>
                        <textarea disabled  class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed" name="observed_results" rows="3" val></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="md:text-base md:mb-3 block  font-bold text-gray-700 mb-1">الصعوبات:</label>
                        <textarea disabled class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed" name="difficulties" rows="3" value={{ $review->observed_results }}></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="md:text-base md:mb-3 block  font-bold text-gray-700 mb-1">إضافات وملاحظات عامة:</label>
                        <textarea disabled  class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed" name="general_notes" rows="3" value={{ $review->general_notes }}></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection