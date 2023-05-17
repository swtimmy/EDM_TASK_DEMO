<div class="flex justify-center">
    <div class="w-[800px] max-w-full">
    <form class="bg-white shadow-md rounded my-4 px-8 pt-6 pb-8 mb-4" wire:submit.prevent="submit">
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="loan_amount">
                Loan amount
            </label>
            <input wire:model.defer="loan_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="loan_amount" type="number" step="1" placeholder="10000" >
            @error('loan_amount') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="annual_interest_rate">
                Annual interest rate
            </label>
            <div class="flex">
                <input wire:model.defer="annual_interest_rate" class="flex-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="annual_interest_rate" type="number" min="0" max="100" step="0.01" placeholder="0">
                <span class="px-3 flex items-center">%</span>
            </div>
            @error('annual_interest_rate') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="loan_term">
                Loan term
            </label>
            <input wire:model.defer="loan_term" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="loan_term" type="number" min="1" max="999" step="1" placeholder="Years">
            @error('loan_term') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <div class="flex items-center">
                <input wire:model="extra" value="on" id="extra" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="extra" class="block text-gray-700 text-sm font-bold ms-2">Monthly fixed extra payment</label>
            </div>
            <div>
            @if($extra)
                <div class="mb-6 mt-2">
                    <input wire:model.defer="monthly_fixed_extra_payment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="monthly_fixed_extra_payment" type="number" step="0.1" min="1" placeholder="Amount">
                    @error('monthly_fixed_extra_payment') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Submit
        </button>
        </div>
    </form>
    </div>
</div>
