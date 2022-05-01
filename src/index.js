import "./index.css"
// import GetGitApi from "./modules/GetGitApi.js"
// const getGitApi = new GetGitApi()

wp.blocks.registerBlockType("ourplugin/pull-git-data", {
    title: "Pull Git Repository",
    icon: "smiley",
    category: "common",
    edit: function () {
      return (
        <div>
          <h3>Your App is ready</h3>
        </div>
      )
    },
    save: function () {
      return null
    }
    
  })
  