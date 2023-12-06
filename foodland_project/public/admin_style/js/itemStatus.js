function addItemStatus() {
    const statusItem = [
        {
            status: ['paid', 'finished', 'used'],
            background: 'green-bg-color'
        },
        {
            status: ['cash on delivery', 'wait to pay','wait to accept'],
            background: 'yellow-bg-color'
        },
        {
            status: ['cancel','unpaid'],
            background: 'red-bg-color'
        },
        {
            status: ['processing'],
            background: 'blue-bg-color'
        },
        {
            status: ['shipping'],
            background: 'light-blue-bg-color'
        }
    ];

    const itemStatusList = document.querySelectorAll('.item-status');

    for (const item of itemStatusList) {
        statusItem.forEach(object => {
            if (object.status.includes(item.innerText.toLowerCase())) {
                item.classList.add(object.background);
            }
        })
    }
}

addItemStatus();
