<div id="table-layout">
    @if($loanId)
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Loan Amount: {{round($loan->loan_amount,2)}}</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Annual Interest Rate: {{round($loan->interest_rate,2)}}%</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Loan Term: {{$loan->loan_term}}Year(s)</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total of {{$loan->years}} Monthly Payment: {{round($loan->total_monthly_payment,2)}}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total Interest: {{round($loan->total_interest,2)}}</p>
                            @isset($loan->total_extra_payment)
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Total Extra Payment: {{round($loan->total_extra_payment,2)}}</p>
                            @endisset
                        </div>
                    </div>
                    <div class="overflow-hidden">
                    <table class="min-w-full text-center text-sm font-light bg-white">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-2">Month</th>
                                <th scope="col" class="px-6 py-2">Interest</th>
                                <th scope="col" class="px-6 py-2">Principal</th>
                                <th scope="col" class="px-6 py-2">Monthly Payment</th>
                                <th scope="col" class="px-6 py-2">Ending Balance</th>
                                @if($type=="extra")
                                    <th scope="col" class="px-6 py-2">Remain Loan Term</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index=>$value)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">{{round($value->month_number,2)}}</td>
                                    <td class="whitespace-nowrap px-6 py-2">{{round($value->interest_component,2)}}</td>
                                    <td class="whitespace-nowrap px-6 py-2">{{round($value->principal_component,2)}}</td>
                                    <td class="whitespace-nowrap px-6 py-2">{{round($value->monthly_payment,2)}}</td>
                                    @if($type=="extra")
                                        <td class="whitespace-nowrap px-6 py-2">{{round($value->remain_loan_balance,2)}}</td>
                                        <td class="whitespace-nowrap px-6 py-2">{{$value->remain_loan_term}}</td>
                                    @else
                                        <td class="whitespace-nowrap px-6 py-2">{{round($value->ending_balance,2)}}</td>
                                    @endif
                                </tr>
                                @if($value->month_number%12==0)
                                <tr class="border-b dark:border-neutral-500 bg-gray-100">
                                    @if($type=="extra")
                                        <td colspan="6" class="whitespace-nowrap px-6 py-2 font-medium text-center">End of Year{{floor($value->month_number/12)}}</td>
                                    @else
                                        <td colspan="5" class="whitespace-nowrap px-6 py-2 font-medium text-center">End of Year{{floor($value->month_number/12)}}</td>
                                    @endif
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
