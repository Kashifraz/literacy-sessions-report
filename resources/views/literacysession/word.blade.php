<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Information Literacy Session') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                <span class="font-medium">Success alert!</span> {{ Session::get('message') }}
            </div>
            @endif
            @if ($errors->all())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
                @foreach ($errors->all() as $error)
                <span class="font-medium">Warning!</span> {{ $error }}
                <br>
                @endforeach
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex " style="width: 700px; margin: auto;">
                    <canvas id="myChart" ></canvas>
                </div>
                <form method="POST" class="mt-5" action="{{ route('word.download') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="session_id" id="session_id" value="<?php echo $literacySession->id ?>">
                    <input type="hidden" name="session_chart_base64" id="session_chart_base64">
                    <p>Your word report file is successfully created. </p>
                    <input type="submit" class="text-gray-900 mt-3 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" value="Download Now">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var labels = <?php echo $categories ?>;
            var strongly_agree_series = <?php echo $strongly_agree_series ?>;
            var agree_series = <?php echo $agree_series ?>;
            var strongly_disagree_series = <?php echo $strongly_disagree_series ?>;
            var disagree_series = <?php echo $disagree_series ?>;
            var no_response_series = <?php echo $no_response_series ?>;
            const data = {
                labels: labels,
                datasets: [{
                        label: 'strongly agree',
                        backgroundColor: '#007635',
                        borderColor: '#007635',
                        data: strongly_agree_series,
                    },
                    {
                        label: 'agree',
                        backgroundColor: '#5EDB64',
                        borderColor: '#5EDB64',
                        data: agree_series,
                    },
                    {
                        label: 'disagree',
                        backgroundColor: '#FF2B2B',
                        borderColor: '#FF2B2B',
                        data: disagree_series,
                    },
                    {
                        label: 'strongly disaggree',
                        backgroundColor: '#CC0000',
                        borderColor: '#CC0000',
                        data: strongly_disagree_series,
                    },
                    {
                        label: 'no response',
                        backgroundColor: '#002060',
                        borderColor: '#002060',
                        data: no_response_series,
                    }
                ]
            };

            function CreateChartImg() {
                var url = myChart.toBase64Image();
                $("#url").attr('src', url);
                $("#session_chart_base64").val(url);
            }

            const config = {
                type: 'bar',
                data: data,
                options: {
                    bezierCurve: false,
                    animation: {
                        onComplete: CreateChartImg
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: "bottom",
                            padding: 5,
                        }
                    }
                }
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        });
    </script>
</x-app-layout>