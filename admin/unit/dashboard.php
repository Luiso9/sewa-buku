<?php
include "../admin/leftbar.php";
?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
	.text-stroke {
		-webkit-text-stroke: 1px gray;
		-webkit-text-fill-color: transparent;
	}
</style>

<div class="container mx-auto px-4">
	<h2 class="text-2xl font-bold mt-8 flex md:justify-center md:items-right">Recent Books</h2>
	<div id="bookCards" class="grid grid-cols-3 grid-rows-3 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
		<div class="w-full h-full rounded-md bg-gray-200 animate-pulse">
			<div class="flex flex-col h-full p-4">
				<div class="flex-grow overflow-hidden">
					<img class="w-full h-48 object-cover rounded-t-md hover:scale-150" src="images/no-image.png"
						alt="Book Cover">
				</div>
				<div class="flex-grow mt-2">
					<h3 class="text-lg font-semibold truncate">Book Title</h3>
					<p class="text-gray-500 mt-1 truncate">Author Name</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Fetch book data from the API
	fetch('https://www.googleapis.com/books/v1/volumes?q=inauthor:&maxResults=6')
		.then(response => response.json())
		.then(data => {
			const bookCards = document.getElementById('bookCards');
			bookCards.innerHTML = '';

			if (data.items) {
				data.items.forEach(item => {
					const book = item.volumeInfo;

					// Create card container
					const cardContainer = document.createElement('a');
					cardContainer.href = "#";
					cardContainer.classList.add('group', 'relative', 'block', 'max-w-screen-sm', 'mx-auto', 'h-64', 'sm:h-80', 'lg:h-96');

					// Create the dashed border span
					const borderSpan = document.createElement('span');
					borderSpan.classList.add('absolute', 'inset-0', 'border-2', 'border-dashed', 'border-black');

					// Create card
					const card = document.createElement('div');
					card.classList.add('relative', 'flex', 'h-full', 'w-64', 'transform', 'items-end', 'border-2', 'border-black', 'bg-white', 'transition-transform', 'group-hover:scale-105');

					// Create initial content
					const initialContent = document.createElement('div');
					initialContent.classList.add('p-4', '!pt-0', 'transition-opacity', 'group-hover:absolute', 'group-hover:opacity-0', 'sm:p-6');

					// Create SVG icon
					const svgIcon = document.createElementNS("http://www.w3.org/2000/svg", "svg");
					svgIcon.setAttribute("xmlns", "http://www.w3.org/2000/svg");
					svgIcon.setAttribute("class", "h-10 w-10 sm:h-12 sm:w-12");
					svgIcon.setAttribute("fill", "none");
					svgIcon.setAttribute("viewBox", "0 0 24 24");
					svgIcon.setAttribute("stroke", "currentColor");

					const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
					path.setAttribute("stroke-linecap", "round");
					path.setAttribute("stroke-linejoin", "round");
					path.setAttribute("stroke-width", "2");
					path.setAttribute("d", "M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z");
					svgIcon.appendChild(path);

					// Create book title for initial content
					const initialTitle = document.createElement('h2');
					initialTitle.classList.add('mt-4', 'text-xl', 'font-medium', 'sm:text-2xl');
					initialTitle.textContent = book.title;

					// Append SVG and title to initial content
					initialContent.appendChild(svgIcon);
					initialContent.appendChild(initialTitle);

					// Create hover content
					const hoverContent = document.createElement('div');
					hoverContent.classList.add('absolute', 'p-4', 'opacity-0', 'transition-opacity', 'group-hover:relative', 'group-hover:opacity-100', 'sm:p-6', 'lg:p-8');

					// Create book title for hover content
					const hoverTitle = document.createElement('h3');
					hoverTitle.classList.add('mt-4', 'text-xl', 'font-medium', 'sm:text-2xl', 'overflow-hidden');		
					hoverTitle.textContent = book.title;

					// Create book author for hover content
					const hoverAuthor = document.createElement('p');
					hoverAuthor.classList.add('mt-4', 'text-sm', 'sm:text-base');
					hoverAuthor.textContent = book.authors?.[0] || 'Unknown Author';

					// Create Read more text for hover content
					const readMore = document.createElement('p');
					readMore.classList.add('mt-8', 'font-bold');
					readMore.textContent = 'Read more';

					// Append elements to hover content
					hoverContent.appendChild(hoverTitle);
					hoverContent.appendChild(hoverAuthor);
					hoverContent.appendChild(readMore);

					// Append initial content and hover content to card
					card.appendChild(initialContent);
					card.appendChild(hoverContent);

					// Append border span and card to card container
					cardContainer.appendChild(borderSpan);
					cardContainer.appendChild(card);

					// Append the card container to the bookCards container
					bookCards.appendChild(cardContainer);
				});
			} else {
				console.error('Invalid data received:', data);
			}
		})
		.catch(error => {
			console.error('Error fetching book data:', error);
		});
</script>
<?php
include "../admin/footer.php";
?>
</body>

</html>