## **Codex CLI** -- Lightweight coding agent that runs in your terminal

- <https://github.com/openai/codex>
- <https://developers.openai.com/codex>
- One agent for everywhere you code
  - Codex is OpenAI’s coding agent for software development. ChatGPT Plus, Pro, Business, Edu, and Enterprise plans include Codex. It can help you:
    - **Write code**: Describe what you want to build, and Codex generates code that matches your intent, adapting to your existing project structure and conventions.
    - **Understand unfamiliar codebases**: Codex can read and explain complex or legacy code, helping you grasp how teams organize systems.
    - **Review code**: Codex analyzes code to identify potential bugs, logic errors, and unhandled edge cases.
    - **Debug and fix problems**: When something breaks, Codex helps trace failures, diagnose root causes, and suggest targeted fixes.
    - **Automate development tasks**: Codex can run repetitive workflows such as refactoring, testing, migrations, and setup tasks so you can focus on higher-level engineering work.

- 有多种使用方式
  - App
  - IDE extension
  - CLI
  - Web


### 在 Codex CLI 中恢复上一次会话

- 1. 打开终端，输入以下命令：

    ```bash
    codex resume --last
    ```
    该命令会直接恢复最近的一次会话，保持之前的上下文不丢失。

- 2. 如果想查看所有历史会话并选择特定会话，可以使用：

    ```bash
    codex resume
    ```
    会弹出会话选择器，显示每次对话的摘要或时间，选择后即可继续 。

- 3. 会话数据默认存储在本地目录，例如：
	- Windows: `C:\Users\username\.codex\sessions`
	- Linux/macOS: `~/.codex/sessions/`
