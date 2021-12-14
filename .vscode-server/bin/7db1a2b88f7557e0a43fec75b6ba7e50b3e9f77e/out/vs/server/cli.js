const path=require("path");delete process.env.ELECTRON_RUN_AS_NODE,process.env.VSCODE_INJECT_NODE_MODULE_LOOKUP_PATH=process.env.VSCODE_INJECT_NODE_MODULE_LOOKUP_PATH||path.join(__dirname,"..","..","..","remote","node_modules"),require("../../bootstrap-node").injectNodeModuleLookupPath(process.env.VSCODE_INJECT_NODE_MODULE_LOOKUP_PATH),require("../../bootstrap-amd").load("vs/server/remoteCli");

//# sourceMappingURL=https://ticino.blob.core.windows.net/sourcemaps/7db1a2b88f7557e0a43fec75b6ba7e50b3e9f77e/core/vs/server/cli.js.map
