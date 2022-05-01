import axios from "axios"

const divResults = document.querySelector('#api-results-div');
const sendBtn = document.querySelector('#send-request');
var input = document.querySelector('#searchId');
const mainDiv = document.querySelector('#main-div');

const urlStart = 'https://api.github.com/users/';
const urlEnd = '/repos';


function callApi(){
    sendBtn.onclick = getResults;
}

async function getResults() {
    try {
      const response = await axios.get(urlStart + input.value + urlEnd);
      const results = response.data
     
      divResults.innerHTML =` 
  <thead class="headline-table">
    <tr>
      <th scope="col">Repository Name</th>
      <th scope="col">Profile</th>
      <th scope="col">Description</th>
      <th scope="col">Size</th>
      <th scope="col">Language</th>
      <th scope="col">Contributors Info</th>
      <th scope="col">logo</th>
    </tr>
  </thead>
   ${results.map(item=>`
   <tbody>
    <tr>
      
      <td class="repo-name">
        <span>
          <span>${item.full_name}</span>
        </span>
      </td>
      <td class="repo-profile">
        <span>
          <span><a href="${item.owner.html_url}">Visit Profile</a></span>
        </span>
      </td>
      <td class="repo-desc">
        <div class="desc-block">
          <div class="hover-me">Hover Me
          <span class="hover-box">${item.description}<span>
          </div>
        </div>
      </td>
      <td class="repo-size">
        <span>
          <span>${item.size}</span>
        </span>
      </td>
      <td class="repo-lang">
        <span>
          <span>${item.language}</span>
        </span>
      </td>
      <td class="repo-contribute">
        <span>
          <span><a href="${item.contributors_url}">Contributors</a></span>
        </span>
      </td>
      <td>
        <span>
          <span class="avatar-img"><img src="${item.owner.avatar_url}"></span>
        </span>
      </td>
    </tr>
  </tbody>`
   ).join("")}`
   
    } catch (e) {
      console.log(e)
    }
    mainDiv.classList.add("show");
  }

  
  callApi()