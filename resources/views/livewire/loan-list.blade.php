<div>
    @if($loanId)
        <div class="flex justify-end pt-2">
            <button wire:click="back" class="mr-2 btn bg-blue-700 rounded text-white py-1 px-5 hover:bg-blue-600">Back</button>
        </div>
        @livewire("table",['loanId'=>$loanId])
        <div class="flex justify-end pt-2">
            <button wire:click="back" class="mr-2 btn bg-blue-700 rounded text-white pb-2 px-5 hover:bg-blue-600">Back</button>
        </div>
    @else
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                <table class="min-w-full text-center text-sm font-light bg-white">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-2">Loan amount</th>
                            <th scope="col" class="px-6 py-2">Annual interest rate</th>
                            <th scope="col" class="px-6 py-2">Loan term</th>
                            <th scope="col" class="px-6 py-2">Monthly fixed extra payment</th>
                            <th scope="col" class="px-6 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-2 font-medium">{{round($item->loan_amount,2)}}</td>
                                <td class="whitespace-nowrap px-6 py-2">{{round($item->interest_rate,2)}}</td>
                                <td class="whitespace-nowrap px-6 py-2">{{$item->loan_term}}</td>
                                @if($item->monthly_fixed_extra_payment==0)
                                    <td class="whitespace-nowrap px-6 py-2">--</td>
                                @else
                                    <td class="whitespace-nowrap px-6 py-2">{{round($item->monthly_fixed_extra_payment,2)}}</td>
                                @endif
                                <td class="whitespace-nowrap px-6 py-2">
                                    <button wire:click="goto({{$item->id}})" class="btn bg-green-700 rounded text-white py-1 px-2 hover:bg-green-600">Detail</button>
                                    <button wire:click="update({{$item->id}})" class=" ml-2 btn bg-orange-700 rounded text-white py-1 px-2 hover:bg-orange-600">Update</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
