<template>
	<main class="flex flex-col gap-y-10">
		<h1 class="text-center text-5xl pt-8">Expense Tracker</h1>
		<form
			v-on:submit.prevent="postExpenses"
			class="flex gap-40 justify-center items-center text-xl mr-10"
		>
			<section class="flex flex-col gap-y-10">
				<aside>
					<label for="type">Payment Type: </label>
					<select
						v-model.lazy="expenseObj.type"
						name="type"
						class="w-80 h-10 p-1"
					>
						<option value="" disabled selected>Type</option>
						<option value="Card">Card</option>
						<option value="Cash">Cash</option>
					</select>
				</aside>
				<aside>
					<label for="date" class="ml-20">Date: </label>
					<input
						v-model.lazy="expenseObj.date"
						type="date"
						name="date"
						id="date"
						placeholder="Date"
						class="border border-black w-80 h-10 p-1"
					/>
				</aside>
			</section>
			<section class="flex flex-col gap-y-10">
				<aside>
					<label for="name" class="ml-[1.1rem]">Name: </label>
					<input
						v-model.lazy="expenseObj.name"
						type="text"
						id="name"
						name="name"
						placeholder="What was the expense?"
						class="h-10 border w-80 p-1 border-black placeholder-gray-500"
					/>
				</aside>
				<aside>
					<label for="amount">Amount: </label>
					<input
						v-model.lazy="expenseObj.amount"
						type="text"
						name="amount"
						id="amount"
						placeholder="Amount"
						class="h-10 p-1 border w-80 border-black"
					/>
				</aside>
			</section>
		</form>
		<div class="flex justify-center">
			<button
				@click="addExpense"
				type="submit"
				class="bg-green-600 hover:bg-green-500 w-52 p-3 rounded-lg text-white text-2xl font-semibold"
			>
				Add
			</button>
		</div>
	</main>
	<ExpenseTable :expenses="this.expenses" :expensesApi="this.expensesApi" />
</template>

<script>
import ExpenseTable from './components/ExpenseTable.vue';

export default {
	name: 'App',
	components: {
		ExpenseTable,
	},
	data() {
		return {
			expensesApi:
				'http://localhost/expense_tracker/php/rest/api/V1/expense_api.php',
			expenses: [],
			expenseObj: {
				type: '',
				name: '',
				date: '',
				amount: '',
			},
		};
	},
	methods: {
		async getExpenses() {
			let result = await fetch(this.expensesApi);
			this.expenses = await result.json();
		},
		addExpense() {
			this.expenses.push({
				type: this.expenseObj.type,
				name: this.expenseObj.name,
				date: this.expenseObj.date,
				amount: this.expenseObj.amount,
			});
			this.postExpenses();
			(this.expenseObj.type = ''),
				(this.expenseObj.name = ''),
				(this.expenseObj.date = ''),
				(this.expenseObj.amount = '');
		},
		async postExpenses() {
			try {
				const response = await fetch(this.expensesApi, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify(this.expenseObj),
				});

				if (!response.ok) {
					throw new Error(
						`Failed to post data. Status: ${response.status} - ${response.statusText}`
					);
				}

				const responseData = await response.json();
				console.log('Expense added:', responseData);
			} catch (error) {
				console.error('Error adding expense:', error);
			}
		},
	},
	created() {
		this.getExpenses();
	},
};
</script>
