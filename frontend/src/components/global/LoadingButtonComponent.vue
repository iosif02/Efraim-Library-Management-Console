<template>
    <div class="loading-spinner">
  		<div class="spinner"></div>
	</div>
</template>
<style scoped>
    .loading-spinner {
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		display: flex;
		justify-content: center;
		align-items: center;
		border-radius: 50px;
		background-color: rgba(0, 0, 0, 0.2);
		position: absolute;
	}
	.spinner {
		border: 4px solid rgba(250, 250, 250, 1); /* Border color of the spinner */
		border-top: 4px solid #3498db; /* Color of the spinning element */
		border-radius: 50%; /* Make the spinner a circle */
		width: 30px; /* Set the width of the spinner */
		height: 30px; /* Set the height of the spinner */
		animation: spin 1s ease infinite; /* Define the spinning animation */
	}
	@keyframes spin {
		/* 0% {
			transform: rotate(0deg);
		}
		100% {
			transform: rotate(360deg);
		} */

		from {
        transform: rotate(0turn);
    	}
    	to {
        	transform: rotate(1turn);
    	}
	}
</style>