## Harness Engineering 与 Agent Harness

### 什么是 Harness Engineering

- **Harness Engineering**是指围绕 AI Agent（特别是 Coding Agent）设计和构建**约束机制、反馈回路、工作流控制和持续改进循环**的系统工程实践。它解决的核心问题是：当 AI Agent 拥有了强大的代码生成能力后，如何确保其输出的可靠性、一致性和长期可维护性。
- "Harness"本意是马具——缰绳、鞍具那一套东西，把马的力气引到正确方向上。拿来类比 AI Agent 挺合适：LLM 就像一匹蛮力十足但方向感不太行的马，跑得快但容易跑偏.

### Agent Harness 的核心概念

- 一句话记忆
  - agent harness 是让 agent 从能输出内容，变成能稳定完成任务的系统层

- 典型能力块通常包括
    1. Context 装配（scope 控制）
       把 domain knowledge、项目态信息、可用工具、权限边界组织成每轮输入，并控制可见范围与优先级
    2. Tool / MCP / Skills 调度
       工具统一接口、参数校验、重试、幂等、回滚、权限控制、降级路径
    3. 约束与流程
       约束 agent 的决策与行动顺序，例如必须给证据、必须先读规范再执行、高风险动作需要人工确认
    4. 外部可读状态（artifacts / state）
       把长期任务进度写到 repo/文件/记录系统，而不是依赖模型记忆跨轮延续
    5. 可观测与评测（observability + eval）
       记录 trace/log，失败分类，回归测试集，确保每次改动可对比、可回放、可追责
