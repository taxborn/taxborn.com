import { execSync } from "child_process";

export function modifiedTime(filePath) {
  return execSync(`git log -1 --pretty="format:%cI" "${filePath}"`).toString();
}
