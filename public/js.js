let table = document.querySelectorAll("table");
if (table) {
    table.forEach((t) => {
        t.classList.add("table", "table-sm", "table-bordered");
    });
}

let thead = document.querySelectorAll("thead");
if (thead) {
    thead.forEach((th) => {
        th.classList.add("text-white", "bg-primary");
    });
}

const getTitle = (elements) => {
    elements.forEach((element) => {
        let uppercase = element.innerHTML.split("_").join(" ").toUpperCase();
        if (uppercase == "BARS") {
            element.innerHTML = '<i class="fa fa-bars" />';
        } else {
            element.innerHTML = uppercase;
        }
    });
};

let th = document.querySelectorAll("th");
if (th.length > 0) {
    getTitle(th);

    th.forEach((element) => {
        element.classList.add("text-nowrap", "text-center");
    });
}

let title = document.querySelectorAll(".title");
if (title.length > 0) {
    getTitle(title);
}

let label = document.querySelectorAll("label");
if (label.length > 0) {
    label.forEach((element) => {
        let uppercase = element.innerHTML.toUpperCase();
        element.innerHTML = uppercase.split("_").join(" ");
    });
}

const setTd = () => {
    let td = document.querySelectorAll("td");
    if (td.length > 0) {
        td.forEach((element) => {
            element.classList.add("text-nowrap");
        });
    }
};

// Component
const Pagination = (data) => {
    const nav = document.querySelector("nav[id=pagination]");

    nav.innerHTML = `<ul class="pagination">
        ${data.links
            .map((link) => {
                if (link.label == "&laquo; Previous") {
                    return `<li class="page-item"><span type='button' onclick="return fetchData(1)" class="page-link">&laquo; First Page</span></li>`;
                }

                if (link.label == "Next &raquo;") {
                    return `<li class="page-item"><span type='button' onclick="return fetchData(${data.last_page})" class="page-link">Last Page &raquo;</span></li>`;
                }

                return `<li class="page-item"><span type='button' onclick="return fetchData(${
                    link.label
                })" class="page-link ${link.active ? "active" : ""}">${
                    link.label
                }</span></li>`;
            })
            .join("")}
    </ul>`;
};

let searchInput = document.querySelector("#search");
if (searchInput) {
    let timer = 0;
    searchInput.addEventListener("keyup", (e) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            fetchData(1, { search: e.target.value });
        }, 1500);
    });
}
// end Component

// handleDelete
const handleDelete = async (url, idDel, token, custom = "") => {
    if (confirm("Yakin hapus data ?")) {
        try {
            const res = await axios.post(`${url}/${idDel}?${custom}`, {
                _method: "DELETE",
                _token: token,
            });

            if (res.data && res.data.status && res.data.status === "success") {
                fetchData(1);
                alert(res.data.msg);
            }
        } catch (err) {
            console.error(err.response);
        }
    }
};
// end handleDelete
